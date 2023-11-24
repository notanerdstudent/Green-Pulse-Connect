<?php

namespace App\Http\Controllers;

use App\Models\BusinessListing;
use App\Models\Post;
use App\Models\ProductReviews;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.pages.home');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function resetForm(Request $request, $token = null)
    {
        $data = [
            'pageTitle' => 'Reset Password',
        ];
        return view('backend.pages.auth.reset-password', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function changeProfilePicture(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = 'backend/dist/img/authors/';
        $file = $request->File('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path . $old_picture;
        $new_picture_name = 'AIMG' . $user->id . time() . rand(1, 100000) . '.jpg';

        if ($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }
        $upload = $file->move(public_path($path), $new_picture_name);
        if ($upload) {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been changed successfully.', 'picture' => $new_picture_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function changeBlogLogo(Request $request)
    {
        $settings = Setting::find(1);
        $logo_path = 'backend/dist/img/logo-favicon/';
        $old_logo = $settings->getAttributes()['blog_logo'];
        $file = $request->file('blog_logo');
        $filename = time() . '_' . rand(1, 100000) . '_logo.png';

        if ($request->hasFile('blog_logo')) {
            if ($old_logo != null && File::exists(public_path($logo_path . $old_logo))) {
                File::delete(public_path($logo_path . $old_logo));
            }
            $upload = $file->move(public_path($logo_path), $filename);

            if ($upload) {
                $settings->update([
                    'blog_logo' => $filename
                ]);
                return response()->json(['status' => 1, 'msg' => 'Logo Has Been Successfully Updated.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something Went Wrong.']);
            }
        }
    }

    public function changeBlogFavicon(Request $request)
    {
        $settings = Setting::find(1);
        $favicon_path = 'backend/dist/img/logo-favicon/';
        $old_favicon = $settings->getAttributes()['blog_favicon'];
        $file = $request->file('blog_favicon');
        $filename = time() . '_' . rand(1, 100000) . '_favicon.ico';

        if ($request->hasFile('blog_favicon')) {
            if ($old_favicon != null && File::exists(public_path($favicon_path . $old_favicon))) {
                File::delete(public_path($favicon_path . $old_favicon));
            }
            $upload = $file->move(public_path($favicon_path), $filename);

            if ($upload) {
                $settings->update([
                    'blog_favicon' => $filename
                ]);
                return response()->json(['status' => 1, 'msg' => 'Favicon Has Been Successfully Updated.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something Went Wrong.']);
            }
        }
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:subcategories,id',
            'featured_image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = 'images/post_images/';
        $file = $request->file('featured_image');
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '_' . auth('web')->id() . '_' . $filename;

        if ($request->hasFile('featured_image')) {
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            $thumb_img = Image::make($file);
            $thumb_img->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            $thumb_img->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));
            if ($upload) {
                $post = new Post();
                $post->author_id = auth('web')->id();
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $post->post_tags = $request->post_tags;
                $saved = $post->save();

                if ($saved) {
                    return response()->json(['status' => 1, 'msg' => 'Post has been created successfully.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong while creating the post.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while uploading the featured image.']);
            }
        }
    }

    public function editPost()
    {
        if (!request()->post_id) {
            return abort(404);
        } else {
            $post = Post::find(request()->post_id);
            $data = [
                'post' => $post,
                'pageTitle' => 'Edit Post'
            ];
            return view('backend.pages.edit-post', $data);
        }
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:subcategories,id',
                'featured_image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            ]);

            $path = "images/post_images/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . auth('web')->id() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            $thumb_img = Image::make($file);
            $thumb_img->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            $thumb_img->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {
                $old_post_image = Post::find($request->post_id)->getAttributes()['featured_image'];
                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);

                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_post_image);
                    }

                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                }
                $post = Post::find($request->post_id);
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $post->post_tags = $request->post_tags;
                $saved = $post->save();

                if ($saved) {
                    return response()->json(['status' => 1, 'msg' => 'Post has been updated successfully.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong while updating the post.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while uploading the featured image.']);
            }
        } else {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:subcategories,id',
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_title = $request->post_title;
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->post_tags = $request->post_tags;
            $saved = $post->save();

            if ($saved) {
                return response()->json(['status' => 1, 'msg' => 'Post has been updated successfully.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while updating the post.']);
            }
        }
    }

    // Business Listings

    public function createBusiness(Request $request)
    {
        $request->validate([
            'listing_title' => 'required|unique:business_listings,name',
            'listing_content' => 'required',
            'listing_location' => 'required',
            'listing_website' => 'required',
            'listing_email' => 'required',
            'listing_is_offline' => 'required',
            'listing_phone' => 'required|min:10|max:10',
        ]);

        $listing = new BusinessListing();
        $listing->user_id = auth('web')->id();
        $listing->name = $request->listing_title;
        $listing->details = $request->listing_content;
        $listing->location = $request->listing_location;
        $listing->website = $request->listing_website;
        $listing->email = $request->listing_email;
        $listing->is_offline = $request->listing_is_offline;
        $listing->phone = $request->listing_phone;
        $saved = $listing->save();

        if ($saved) {
            return response()->json(['status' => 1, 'msg' => 'Business Listing has been created successfully.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong while creating the post.']);
        }
    }

    public function editBusiness()
    {
        if (!request()->listing_id) {
            return abort(404);
        } else {
            $listing = BusinessListing::find(request()->listing_id);
            $data = [
                'listing' => $listing,
                'pageTitle' => 'Edit Business Listing'
            ];
            return view('backend.pages.edit-business', $data);
        }
    }

    public function updateBusiness(Request $request)
    {
        $request->validate([
            'listing_title' => 'required|unique:business_listings,name,' . $request->post_id,
            'listing_content' => 'required',
            'listing_location' => 'required',
            'listing_website' => 'required',
            'listing_email' => 'required',
            'listing_is_offline' => 'required',
            'listing_phone' => 'required|min:10|max:10',
        ]);

        $listing = BusinessListing::find($request->listing_id);
        $listing->name = $request->listing_title;
        $listing->details = $request->listing_content;
        $listing->location = $request->listing_location;
        $listing->website = $request->listing_website;
        $listing->email = $request->listing_email;
        $listing->is_offline = $request->listing_is_offline;
        $listing->phone = $request->listing_phone;
        $listing->slug = null;
        $saved = $listing->save();


        if ($saved) {
            return response()->json(['status' => 1, 'msg' => 'Listing has been updated successfully.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong while updating the listing.']);
        }
    }

    // Product Reviews
    public function createProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:product_reviews,product_name',
            'post_content' => 'required',
            'brand' => 'required',
            'purchase_url' => 'required',
            'product_rating' => 'required',
            'product_image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = 'images/product_images/';
        $file = $request->file('product_image');
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '_' . auth('web')->id() . '_' . $filename;

        if ($request->hasFile('product_image')) {
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            $thumb_img = Image::make($file);
            $thumb_img->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            $thumb_img->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));
            if ($upload) {
                $product = new ProductReviews();
                $product->user_id = auth('web')->id();
                $product->product_name = $request->product_name;
                $product->product_image = $new_filename;
                $product->rating = $request->product_rating;
                $product->review = $request->post_content;
                $product->brand = $request->brand;
                $product->purchase_url = $request->purchase_url;
                $saved = $product->save();

                if ($saved) {
                    return response()->json(['status' => 1, 'msg' => 'Post has been created successfully.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong while creating the post.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while uploading the featured image.']);
            }
        }
    }

    public function editProduct()
    {
        if (!request()->product_id) {
            return abort(404);
        } else {
            $product = ProductReviews::find(request()->product_id);
            $data = [
                'product' => $product,
                'pageTitle' => 'Edit Product'
            ];
            return view('backend.pages.edit-product', $data);
        }
    }

    public function updateProduct(Request $request)
    {
        if ($request->hasFile('product_image')) {
            $request->validate([
                'product_name' => 'required|unique:product_reviews,product_name,' . $request->product_id,
                'post_content' => 'required',
                'brand' => 'required',
                'purchase_url' => 'required',
                'product_rating' => 'required',
                'product_image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            ]);

            $path = "images/product_images/";
            $file = $request->file('product_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . auth('web')->id() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            $thumb_img = Image::make($file);
            $thumb_img->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            $thumb_img->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {
                $old_post_image = Post::find($request->post_id)->getAttributes()['product_image'];
                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);

                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_post_image);
                    }

                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                }
                $product = ProductReviews::find($request->post_id);
                $product->product_name = $request->product_name;
                $product->product_image = $new_filename;
                $product->rating = $request->product_rating;
                $product->review = $request->post_content;
                $product->brand = $request->brand;
                $product->purchase_url = $request->purchase_url;
                $saved = $product->save();

                if ($saved) {
                    return response()->json(['status' => 1, 'msg' => 'Product has been updated successfully.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong while updating the product.']);
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while uploading the featured image.']);
            }
        } else {
            $request->validate([
                'product_name' => 'required|unique:product_reviews,product_name,' . $request->product_id,
                'post_content' => 'required',
                'brand' => 'required',
                'purchase_url' => 'required',
                'product_rating' => 'required',
            ]);

            $product = ProductReviews::find($request->product_id);
            $product->product_name = $request->product_name;
            $product->rating = $request->product_rating;
            $product->review = $request->post_content;
            $product->brand = $request->brand;
            $product->purchase_url = $request->purchase_url;
            $saved = $product->save();

            if ($saved) {
                return response()->json(['status' => 1, 'msg' => 'Product has been updated successfully.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong while updating the product.']);
            }
        }
    }
}

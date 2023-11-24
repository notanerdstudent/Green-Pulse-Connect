@extends('frontend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@push('stylesheets')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPL0ScxAtc+UYbHAgvd+sjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="/frontend/css/main.css">
@endpush
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">
  <div class="container position-relative">
    <div class="row gy-5" data-aos="fade-in">
      <div class="col-lg-6 order-2 order-lg-1 d-flex align-items-center flex-column justify-content-center text-center">
        <h2>Welcome to <span>{{blogInfo()->blog_name}}</span></h2>
        <p>{{blogInfo()->blog_description}}</p>
        <div class="d-flex justify-content-center justify-content-lg-start">
          @if (Auth::check())
            <a href="{{route('author.home')}}" class="btn-get-started">Dashboard</a>
          @else
            <a href="{{route('author.login')}}" class="btn-get-started">Get Started</a>
          @endif
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2">
        <img src="/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
      </div>
    </div>
  </div>

  <div class="icon-boxes position-relative">
    <div class="container position-relative">
      <div class="row gy-4 mt-5">

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-chat-left"></i></div>
            <h4 class="title"><a href="{{route('forum.index')}}" class="stretched-link">Community Forum</a></h4>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-file-post"></i></div>
            <h4 class="title"><a href="{{route('blog')}}" class="stretched-link">Eco-Friendly Blog</a></h4>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-bag"></i></div>
            <h4 class="title"><a href="" class="stretched-link">Eco-Friendly Product Reviews</a></h4>
          </div>
        </div><!--End Icon Box -->

        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-tree"></i></div>
            <h4 class="title"><a href="{{route('business')}}" class="stretched-link">Green Business Directory</a></h4>
          </div>
        </div><!--End Icon Box -->

      </div>
    </div>
  </div>

  </div>
</section>
<!-- End Hero Section -->

<main id="main">

  <!-- ======= About Us Section ======= -->
  <section id="about" class="about sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>About Us</h2>
      </div>

      <div class="row gy-4">
        <div class="col-lg-6">
          <h3>Navigating the Sustainable Future</h3>
          <img src="/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
          <p>At GreenPulseConnect, we are driven by a collective passion for sustainability, innovation, and a deep commitment to fostering positive change in the world. Our platform serves as a dynamic hub, bringing together individuals, businesses, and communities dedicated to navigating a sustainable future.</p>
          <p>We believe in the power of information and connection to drive meaningful change. GreenPulseConnect is not just a website; it's a movement. Our mission is to empower individuals and businesses to make eco-conscious choices, steering the world towards a more sustainable and harmonious existence.</p>
        </div>
        <div class="col-lg-6">
          <div class="content ps-0 ps-lg-5">
            <p class="fst-italic">
              GreenPulseConnect stands out for its community-driven approach. Our Eco-Friendly Blog and Product Reviews are not just curated by us but are a tapestry of insights, experiences, and recommendations from our diverse community.
            </p>
            <ul>
              <li><i class="bi bi-check-circle-fill"></i> Join our vibrant community forum, where ideas flow freely, experiences are shared, and sustainable collaborations take root. Engage with eco-enthusiasts, businesses, and advocates actively shaping a sustainable tomorrow.</li>
              <li><i class="bi bi-check-circle-fill"></i> Explore businesses that align with sustainable values. Our Green Business Directory is a reflection of the community's choices, featuring enterprises committed to ethical practices and eco-friendly products and services.</li>
              <li><i class="bi bi-check-circle-fill"></i> Immerse yourself in our community-driven Eco-Friendly Blog. Authored by passionate individuals, it covers diverse topics—from personal eco-journeys to insights into sustainable practices. Share your story and inspire others!</li>
              <li><i class="bi bi-check-circle-fill"></i> Navigate sustainable consumerism through our community's lens. Our Eco-Friendly Product Reviews are curated by individuals passionate about sustainability, providing real-world insights into the environmental impact of products.</li>
            </ul>
            <p>
              <b><i>Together, let's navigate the sustainable future. Welcome to GreenPulseConnect — where positive change is woven into every community-authored post.</i></b>
            </p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End About Us Section -->
  <!-- ======= Stats Counter Section ======= -->
  <section id="stats-counter" class="stats-counter">
    <div class="container" data-aos="fade-up">

      <div class="row gy-4 align-items-center">

        <div class="col-lg-6">
          <img src="/img/stats-img.svg" alt="" class="img-fluid">
        </div>

        <div class="col-lg-6">

          <div class="stats-item d-flex align-items-center">
            <span data-purecounter-start="0" data-purecounter-end="414" data-purecounter-duration="1" class="purecounter"></span>
            <p>Each <strong>internet user is responsible</strong> for 414kg (912lbs) of carbon dioxide a year.</p>
          </div><!-- End Stats Item -->

          <div class="stats-item d-flex align-items-center">
            <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
            <p>The carbon emissions of <strong>delivering online purchases</strong> are expected to grow 30% by 2030</p>
          </div><!-- End Stats Item -->

          <div class="stats-item d-flex align-items-center">
            <span data-purecounter-start="0" data-purecounter-end="1.7" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>The manufacture and running of digital technologies</strong> are estimated to produce 1.7 billion tonnes (1.6 billion tons) of greenhouse gas emissions.</p>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </div>
  </section><!-- End Stats Counter Section -->

  <!-- ======= Call To Action Section ======= -->
  <section id="call-to-action" class="call-to-action">
    <div class="container text-center" data-aos="zoom-out">
      <h3>Call For Sustainable Development</h3>
      <p>Sustainable development is crucial as it meets the needs of the present without compromising the ability of future generations to meet their own needs. It aims to achieve a balance between economic progress, environmental preservation, and social equity.</p>
      <a class="cta-btn" href="https://www.undp.org/sustainable-development-goals">Sustainable Development Goals</a>
    </div>
  </section><!-- End Call To Action Section -->

  <!-- ======= Our Services Section ======= -->
  <section id="services" class="services sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Global Sustainability News</h2>
        <p>Stay informed about the latest developments in sustainable policies, technologies, and initiatives from around the world.</p>
      </div>

      <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-4 col-md-6">
          <div class="service-item  position-relative">
            <div class="icon">
              <i class="bi bi-activity"></i>
            </div>
            <h3>10-Year Framework Programme on Sustainable Consumption and Production</h3>
            <p> Supported by the Indian government, this programme focuses on promoting sustainable consumption and production patterns.</p>
            <a href="https://www.oneplanetnetwork.org/about/10-year-framework-programmes-sustainable-consumption-production" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-cloud-fog"></i>
            </div>
            <h3>Smog Free Project</h3>
            <p>This is the world’s first smog vacuum cleaner that transforms air pollution into jewelry. It’s an innovative approach to tackle air pollution.</p>
            <a href="https://www.studioroosegaarde.net/project/smog-free-tower" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-sun"></i>
            </div>
            <h3>Zéphyr Solar</h3>
            <p>This is an autonomous solar balloon that provides electricity to disaster zones. It’s a sustainable technology that aids in disaster management.</p>
            <a href="https://www.bbeb.com/post/102gy6y/zephyr-solar-an-autonomous-solar-balloon-bringing-electricity-to-disaster-zones" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-gear-wide-connected"></i>
            </div>
            <h3>UpLink</h3>
            <p>An initiative by the World Economic Forum, UpLink seeks sustainable solutions to tackle issues such as climate change and social injustice.</p>
            <a href="https://uplink.weforum.org/uplink/s/" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-hourglass"></i>
            </div>
            <h3>Green Building Initiative (GBI)</h3>
            <p>This international effort aims to create sustainable, resource-efficient buildings. It promotes green building practices and reduces environmental impact.</p>
            <a href="https://thegbi.org/" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-bounding-box-circles"></i>
            </div>
            <h3>National Action Plan on Climate Change (NAPCC)</h3>
            <p>This is an overarching policy framework implemented by the Indian government. It aims to address climate change issues and promote sustainable development.</p>
            <a href="https://static.pib.gov.in/WriteReadData/specificdocs/documents/2021/dec/doc202112101.pdf" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>
  </section><!-- End Our Services Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Global Ecological Crisis</h2>
        <p>Unraveling the Global Environmental Dilemmas - An Overview of Current Environmental Challenges</p>
      </div>

      <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <b>Land and Sea Use Changes:</b> The biggest driver of biodiversity loss is how people use the land and sea. This includes the conversion of land covers such as forests, wetlands, and other natural habitats for agricultural and urban uses.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <b>Nature Crisis:</b> We are experiencing a dangerous decline in nature, and humans are causing it. We are using the equivalent of 1.6 Earths to maintain our current way of life, and ecosystems cannot keep up with our demands. One million of the world’s estimated 8 million species of plants and animals are threatened with extinction.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <b>Global Warming from Fossil Fuels:</b> As of May 2023, CO2 PPM (parts per million) is at 420.00 and the global temperature rise is 1.15C compared to pre-industrial levels. This is causing catastrophic events all over the world, such as devastating bushfire seasons, locust swarms decimating crops, and unprecedented heatwaves.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <b>Poor Governance:</b> The climate crisis is a result of multiple market failures. Economists and environmentalists have urged policymakers for years to increase the price of activities that emit greenhouse gases. However, governments must not only massively increase funding for green innovation but also adopt a range of other policies that address each of the other market failures.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-wrap">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <b>Invasive Alien Species:</b> Invasive alien species (IAS) are animals, plants, fungi, and microorganisms that have entered and established themselves in the environment outside their natural habitat. IAS have devastating impacts on native plant and animal life, causing the decline or even extinction of native species and negatively affecting ecosystems.
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          </div><!-- End testimonial item -->

        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="content px-xl-5">
            <h3>Frequently Asked <strong>Questions</strong></h3>
            <p>
              This section provides answers to five frequently asked questions about sustainability and eco-friendliness, offering insights into the importance of these concepts and how they can be implemented in our daily lives. It serves as a quick guide for those interested in understanding and contributing to a sustainable future. 
            </p>
          </div>
        </div>

        <div class="col-lg-8">

          <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                  <span class="num">1.</span>
                  What is sustainability?
                </button>
              </h3>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Sustainability comes from ‘to sustain’, which essentially means to provide support and prolong or preserve something. We hope to preserve and support life on planet earth. Sustainability is an approach to life that causes the least possible harm to the natural world or living organisms.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                  <span class="num">2.</span>
                  Why is sustainability important?
                </button>
              </h3>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  The main goal of sustainability is to protect the planet so that future generations don’t have to suffer. We only have finite resources on this planet, but we’re currently not being considerate of that. Our actions now shouldn’t be at the expense of our fellow creatures or humans, so it’s important to be aware of sustainability in our daily lives so we don’t cause more irreparable damage to Earth.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                  <span class="num">3.</span>
                  What are the 3 pillars of sustainability?
                </button>
              </h3>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  The three pillars of sustainability are the environment, economy, and society. All of them, directly and indirectly, impact each other – none of these pillars stand alone. This is why it’s important to consider everything when we’re talking about sustainability, from materials and wastage to human treatment and working conditions.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                  <span class="num">4.</span>
                  What’s the difference between sustainability and eco-friendly?
                </button>
              </h3>
              <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  Eco-friendly means ‘not environmentally harmful’. Everything from production, manufacturing, and packaging should be favorable and safe for the planet in terms of products. For a product to qualify as eco-friendly, the packaging process must be top-notch and environmentally responsible.
                </div>
              </div>
            </div><!-- # Faq item-->

            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                  <span class="num">5.</span>
                  How can we maintain an eco-friendly and sustainable environment?
                </button>
              </h3>
              <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body">
                  To help reduce footprint, considerable shifts in the way companies produce their products are a must-do thing. We, as consumers, on the other hand, need to revisit how we dispose of these products. That way, our planet will stand out more than before.
                </div>
              </div>
            </div><!-- # Faq item-->

          </div>

        </div>
      </div>

    </div>
  </section><!-- End Frequently Asked Questions Section -->

  <!-- ======= Recent Blog Posts Section ======= -->
  <section id="recent-posts" class="recent-posts">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Recent Blog Posts</h2>
        <p>Stay updated on the latest eco-trends and sustainability insights - dive into our recent blog posts for a pulse on the ever-evolving landscape of a greener, more sustainable world.</p>
      </div>

      <div class="row gy-4">

        @foreach (latest_sidebar_posts() as $item)
        <div class="col-xl-4 col-md-6">
          <article>

            <div class="post-img">
              <img src="/storage/images/post_images/thumbnails/resized_{{$item->featured_image}}" alt="" class="img-fluid">
            </div>

            <p class="post-category">{{$item->subcategory->subcategory_name}}</p>

            <h2 class="title">
              <a href="{{route('read_post', $item->post_slug)}}">{{$item->post_title}}</a>
            </h2>

            <div class="d-flex align-items-center">
              <img src="{{$item->author->picture}}" alt="" class="img-fluid post-author-img flex-shrink-0">
              <div class="post-meta">
                <p class="post-author">{{$item->author->name}}</p>
                <p class="post-date">
                  <time datetime="2022-01-01">{{data_formatter($item->created_at)}}</time>
                </p>
              </div>
            </div>

          </article>
        </div>
        @endforeach

      </div><!-- End recent posts list -->

    </div>
  </section><!-- End Recent Blog Posts Section -->

  <!-- ======= Contact Section ======= -->
  {{-- <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Contact</h2>
        <p>Connect with us and let your voice be heard - reach out through our contact form to share ideas, ask questions, or simply join the conversation on building a sustainable future!</p>
      </div>

      <div class="row gx-lg-0 gy-4">

        <div class="col-lg-4">

          <div class="info-container d-flex flex-column align-items-center justify-content-center">
            <div class="info-item d-flex">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h4>Location:</h4>
                <p>Rohini, New Delhi - 110086</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h4>Email:</h4>
                <p>akshutgoyal2301@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-phone flex-shrink-0"></i>
              <div>
                <h4>Call:</h4>
                <p>+91 9910526475</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-clock flex-shrink-0"></i>
              <div>
                <h4>Open Hours:</h4>
                <p>Mon-Sat: 9AM - 5PM</p>
              </div>
            </div><!-- End Info Item -->
          </div>

        </div>

        <div class="col-lg-8">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div><!-- End Contact Form -->

      </div>

    </div>
  </section> --}}
  <!-- End Contact Section -->

</main><!-- End #main -->

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            "use strict";
            /**
             * Initiate glightbox
             */
            const glightbox = GLightbox({
                selector: ".glightbox",
            });

            /**
             * Scroll top button
             */
            const scrollTop = document.querySelector(".scroll-top");
            if (scrollTop) {
                const togglescrollTop = function () {
                    window.scrollY > 100
                        ? scrollTop.classList.add("active")
                        : scrollTop.classList.remove("active");
                };
                window.addEventListener("load", togglescrollTop);
                document.addEventListener("scroll", togglescrollTop);
                scrollTop.addEventListener(
                    "click",
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth",
                    })
                );
            }

            /**
             * Initiate Pure Counter
             */
            new PureCounter();

            /**
             * Init swiper slider with 3 slides at once in desktop view
             */
            new Swiper(".slides-3", {
                speed: 600,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                slidesPerView: "auto",
                pagination: {
                    el: ".swiper-pagination",
                    type: "bullets",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 40,
                    },

                    1200: {
                        slidesPerView: 3,
                    },
                },
            });
        });

    </script>
@endpush
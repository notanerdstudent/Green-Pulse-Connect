<div>
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>        
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    <form action="./" wire:submit.prevent="SignupHandler()" method="post" autocomplete="off" novalidate>
        <div class="mb-2">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Name" autocomplete="off" wire:model="name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Username" autocomplete="off" wire:model="username">
            @error('username')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Email" autocomplete="off" wire:model="email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                Password
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Password" autocomplete="off" wire:model="password">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2 mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" required name="agree" wire:model="agree"/>
                <span class="form-check-label">Agree to the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a></span>
            </label>
            @error('agree')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100 bg-main">Sign up</button>
        </div>
    </form>
</div>

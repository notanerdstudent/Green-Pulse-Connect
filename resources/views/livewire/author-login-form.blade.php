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

    <form action="./" wire:submit.prevent="LoginHandler()" method="post" autocomplete="off" novalidate>
        <div class="mb-3">
            <label class="form-label">Email or Username</label>
            <input type="text" class="form-control" placeholder="Email or Username" autocomplete="off" wire:model="login_id">
            @error('login_id')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                Password
                <span class="form-label-description">
                    <a href="{{ route('author.forgot-password') }}" class="color-main">Forgot Password</a>
                </span>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Password" autocomplete="off" wire:model="password">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" />
                <span class="form-check-label">Remember me on this device</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100 bg-main">Sign in</button>
        </div>
    </form>
</div>

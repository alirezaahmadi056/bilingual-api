<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
         @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div style="background:#ed4337;color:white;border-radius:10px;padding: 10px;text-align:center">{{$error}}</div>
            @endforeach
         @endif

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('شماره')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمز عبور')" />
            <x-text-input id="password" class="block mt-1 w-full" type="text" name="password" :value="old('password')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4 flex justify-center">
            <div name="g_recaptcha" class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_GOOGLE_SITE_KEY') }}"></div>
        </div>
    

        <div class="flex items-center justify-end mt-5">
            <x-primary-button class="w-full bg-primary text-[#FFFFFF] font-bold">
                {{ __('ورود') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

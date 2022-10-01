<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/user">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('お名前')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Eメール')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('携帯電話番号')" />

                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('住所')" />

                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('パスワード')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('パスワード確認')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                {{--<!-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('user.login') }}">
                    {{ __('ログイン画面') }}
                </a> -->--}}
                
                <x-primary-button class="ml-4">
                    {{ __('新規作成') }}
                </x-primary-button>
        </form>
        <form action="{{ route('user.login')}}">
                <x-primary-button class="ml-4">
                    {{ __('ログイン画面') }}
                </x-primary-button>
        </form>

            </div>
        
    </x-auth-card>
</x-guest-layout>

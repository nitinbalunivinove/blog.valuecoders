<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo"></x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register-me') }}" class="user" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
	            <input type="file" class="form-control-file" name="user_image" id="user_image" aria-describedby="fileHelp">
	            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 5MB.</small>
        	</div>

            <div class="form-group">
                <x-jet-button class="">
                    {{ __('Final Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

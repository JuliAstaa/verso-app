<x-layouts.app title="Verso-App">

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @include('sections.profile.sidebar.header')

        {{-- Bungkus Wallet & Modal dalam satu x-data --}}
        <div x-data="{ 
            showModal: false, 
            showForm: false, 
            selectedMethod: '',
            openForm(method) {
                this.selectedMethod = method;
                this.showForm = true;
                this.showModal = false;
            }
        }">
            @include('sections.profile.sidebar.menu-wallet')
            @include('sections.profile.sidebar.pop-up')
        </div>

        @include('sections.profile.sidebar.navigation-menu')

    </div>

</x-layouts.app>
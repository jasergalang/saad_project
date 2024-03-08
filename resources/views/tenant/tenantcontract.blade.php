@extends('layout.authlayout')

@section('content')
    @include('layout.header')
    @include('layout.ownernav')

    <form action="{{ route('createcontract', ['inquiries_id' => $inquiries_id]) }}" method="post">
        @csrf

        {{-- Title and desc --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Name of the Property</div>

            <div class="mx-36 my-20">
                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mr-1 mb-2">Property: </div>
                    <input type="text" placeholder="" disabled value="{{ $propertyTitle }}" class="rounded-md border border-gray-300 ml-12 w-full">
                </div>
            </div>
        </div>
        {{-- end of Title and desc --}}

        {{-- Tenants Name --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Name</div>

            <div class="mx-36 my-20">
                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mr-1 mb-2">Name of Tenant: </div>
                    <input type="text" disabled value="{{ $tenantDetails->fname }} {{ $tenantDetails->lname }}" placeholder="" class="rounded-md border border-gray-300 ml-28 w-96">
                </div>
            </div>
        </div>
        {{-- end of Tenants name --}}

        {{-- Tenants Contact --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Tenants Contact</div>

            <div class="mx-36 my-20">
                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mr-1 mb-2">Number: </div>
                    <input type="text" disabled value="{{ $tenantDetails->contact }}" placeholder="" class="rounded-md border border-gray-300 ml-28 w-96">
                </div>

                <div class="flex items-center py-3">
                    <div class="text-base font-semibold mb-2">Email: </div>
                    <input type="text" disabled value="{{ $tenantDetails->email }}" placeholder="" class="rounded-md border border-gray-300 ml-32 w-96">
                </div>
            </div>
        </div>
        {{-- end of Tenants Contact --}}

        {{-- basic info --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Method of Payment</div>

            <div class="mx-36 my-20">
                <div class="mb-6 mx-10 flex items-center">
                    <div class="text-base font-semibold mb-2">Payment Method:</div>
                    <select class="ml-7 rounded-md border border-gray-300 p-2 w-96 " name="payment_method">
                        <option>--Choose One--</option>
                        <option>Digital</option>
                        <option>Physical</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- end of Basic Info --}}

        {{-- Rent Duration --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Rent Duration</div>

            <div class="mx-36 my-20">
                <div class="mb-6 mx-10 flex items-center">
                    <div class="text-base font-semibold mb-2">Start Date:</div>
                    <input type="date" name="start_date" class="ml-7 rounded-md border border-gray-300 p-2 w-96">
                </div>

                <div class="mb-6 mx-10 flex items-center">
                    <div class="text-base font-semibold mb-2">End Date:</div>
                    <input type="date" name="end_date" class="ml-7 rounded-md border border-gray-300 p-2 w-96">
                </div>
            </div>
        </div>
        {{-- end of Rent Duration --}}

        {{-- Payment Agreement --}}
        <div class="container mx-auto p-6 bg-white">
            <div class="text-lg font-bold mb-4 my-10 mx-20 border-b">Agreement on Payment</div>

            <div class="mx-36 my-20">
                <div class="mb-6 mx-10 flex items-center">
                    <div class="text-base font-semibold mb-2">Payment Agreement:</div>
                    <select class="ml-7 rounded-md border border-gray-300 p-2 w-96" name= "payment_agreement">
                        <option>--Choose One--</option>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- end of Payment Agreement --}}

        {{-- Go Button --}}
        <div class="container mx-auto p-6 bg-white">
            <button type="submit" class="bg-primary hover:bg-transparent border hover:border-primary text-white hover:text-primary font-bold py-2 px-4 rounded-md my-20 mx-auto block">
                Create Contract
            </button>
        </div>
    </form>

    @include('layout.footer')
@endsection

@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
@endsection

@extends('layout.authlayout')

@section('content')
{{-- login --}}
@include('layout.tenantHeader')

@include('layout.nav')

<div class="container p-6 bg-white">
        {{-- page title --}}
        <div class="container py-4 flex items-center gap-3">
            <a href="index" class="text-primary text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-sm text-gray-400">
                <i class="fas fa-chevron-right"></i>
            </span>
            <p class="text-gray-600 font-medium">Rent</p>
        </div>
        {{-- end ng page title --}}

        {{-- product page --}}
        <div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
            {{-- sidebar --}}

            {{-- Property listings --}}
            <div class="col-span-3">
                <div class="grid grid-cols-2 gap-6 pt-4 pb-16 items-start">
                    @foreach ($properties->unique('id') as $property)
                        <div class="bg-white shadow rounded overflow-hidden group  hover:shadow-2xl hover:scale-105 transition">
                            <div class="relative ">
                                <img src="{{ asset('/storage/images/' . optional($property->image)->image_path) }}" alt="logo" class="w-full h-56 mx-auto block">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                    <!-- Additional overlay content if needed -->
                                </div>
                            </div>
                            <div class="pt-4 pb-3 px-4">
                                <a href="#">
                                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">{{ optional($property->description)->title }}</h4>
                                </a>
                                <p class="text-xl text-primary font-semibold">
                                    Address: {{ optional($property->address)->unit_number }} {{ optional($property->address)->floor }} {{ optional($property->address)->street }} {{ optional($property->address)->city }}


                                </p><br>

                                <p class="text-gray-600">{{ optional($property->description)->description }}</p>
                                <p class="text-xl text-primary font-semibold">
                                    @if ($property->monthly_rate)
                                        Contact agent for price
                                    @else
                                        Price: {{ optional($property->rate)->monthly_rate }}
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('viewproperty', ['id' => $property->id]) }}" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">View</a>
                        </div>
                    @endforeach
                </div>
            </div>
</div>

{{-- end of product page --}}
</div>

@include('layout.footer');
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

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->all());
            alert(errorMessage.join('\n'));
        </script>
    @endif
@endsection


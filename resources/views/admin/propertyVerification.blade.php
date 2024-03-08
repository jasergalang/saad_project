<div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg" id="propertylist">
    <table class="table-auto w-full border-transparent">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 20%;">Photo</th>
                <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 30%;">Landlord Name</th>
                <th class="px-4 py-2 border-b border-r border-gray-400" style="width: 35%;">Place Name</th>
                <th class="py-2 px-3 text-gray-800 border-b border-gray-400" style="width: 15%;">Verification</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
            <tr>
                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                    <img src="{{asset('/storage/images/' . optional($property->image)->image_path) }}" alt="Property Photo">
                </td>
                <td class="px-4 py-2 border-b border-gray-400" style="width: 25%;">
                    {{ $property->owner->account->fname }} {{ $property->owner->account->lname }}
                </td>
                <td class="px-4 py-2 border-b border-gray-400" style="width: 30%;">
                    {{ $property->description->title }}
                </td>
                <td class="px-5 py-2 border-b border-gray-400 text-center" style="width: 15%;">
                    @if ($property->verification_status == 'verified')
                        Verified
                    @else
                        <form method="POST" action="{{ route('admin.verify.property', ['id' => $property->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

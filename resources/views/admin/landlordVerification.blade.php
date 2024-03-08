
<div class="overflow-x-auto py-5 my-3 bg-gray-300 rounded-lg"id="landlordlist">
    <table class="table-auto w-full border-transparent">
        <thead>
            <tr>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">ID</th>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Name</th>
                <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400">Email</th>
                <th class="py-2 text-gray-800 border-b border-gray-400">Verification</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($owners as $owner)
            <tr>
                <td class="px-4 py-2 border-b border-gray-400">{{ $owner->id }}</td>
                <td class="px-4 py-2 border-b border-gray-400">
                    {{ optional($owner->account)->fname }} {{ optional($owner->account)->lname }}
                </td>
                <td class="px-4 py-2 border-b border-gray-400">
                    {{ optional($owner->account)->email }}
                </td>
                <td class="px-4 py-2 border-b border-gray-400 text-center">
                    @if($owner->verification_status == 'verified')
                        Verified
                    @else
                        <form method="POST" action="{{ route('admin.verify.landlord', ['id' => $owner->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-transparent rounded-md px-5 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
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


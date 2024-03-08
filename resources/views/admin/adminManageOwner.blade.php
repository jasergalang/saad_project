<div class="container mt-3 mx-auto border rounded-sm py-5 border-gray-400" id="verilandlordlist">
    <div class="px-4 pb-2 overflow-hidden">
        <div class="mr-14 flex items-center">
            <h3 class="text-xl mt-5 font-semibold">
                Landlords
            </h3>
        </div>
    </div>

    <div class="overflow-x-auto my-3 bg-gray-300 rounded-lg max-h-[400px]">
        <table class="table-auto w-full border-transparent">
            <thead class="sticky top-0 bg-white">
                <tr>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">ID</th>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Name</th>
                    <th class="px-4 py-2 text-gray-800 border-b border-r border-gray-400 bg-gray-300">Email</th>
                    <th class="py-2 text-gray-800 border-b border-gray-400 bg-gray-300">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($owners as $owner)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->id }}</td>
                        <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->account->fname}} {{$owner->account->lname}}</td>
                        <td class="px-4 py-2 border-b border-gray-400 bg-gray-300">{{ $owner->account->email }}</td>
                        <td class="px-4 py-2 border-b border-gray-400 text-center bg-gray-300">
                            <form action="{{ route('admin.destroy.owner', $owner->account->owner->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent rounded-md px-5 py-1 hover:bg-primary hover:border-b hover:border-t hover:border-primary hover:text-white font-bold">
                                    <i class="fa-solid fa-x"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

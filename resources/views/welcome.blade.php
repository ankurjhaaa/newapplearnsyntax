<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-4">

    <!-- MOBILE Add Button -->
    <div class="md:hidden mb-4">
        <button onclick="openModal()" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg">
            + Add Course
        </button>
    </div>

    <!-- GRID (Desktop) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- LEFT FORM (Desktop Only) -->
        <div class="hidden md:block bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Add New Course</h2>

            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="font-medium">Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="font-medium">Description</label>
                    <textarea name="description" class="w-full border rounded p-2"></textarea>
                </div>

                <div>
                    <label class="font-medium">Duration</label>
                    <input type="text" name="duration" class="w-full border rounded p-2" placeholder="e.g. 2 Months">
                </div>

                <div>
                    <label class="font-medium">Start Date</label>
                    <input type="date" name="start_date" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="font-medium">Image</label>
                    <input type="file" name="image" class="w-full border rounded p-2">
                </div>

                <button class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Course
                </button>
            </form>
        </div>

        <!-- RIGHT TABLE (Responsive) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">All Courses</h2>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[650px] border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Image</th>
                            <th class="p-2 border">Title</th>
                            <th class="p-2 border">Duration</th>
                            <th class="p-2 border">Start Date</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="text-center">
                                <td class="border p-2">
                                    @if ($course->image)
                                        <img src="{{ $course->image }}" class="h-12 w-12 rounded mx-auto object-cover" />

                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="border p-2">{{ $course->title }}</td>
                                <td class="border p-2">{{ $course->duration }}</td>
                                <td class="border p-2">{{ $course->start_date }}</td>

                                <td class="border p-2">
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>


    <!-- MOBILE FORM MODAL -->
    <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">

        <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-lg">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Add Course</h2>
                <button onclick="closeModal()" class="text-2xl font-bold">&times;</button>
            </div>

            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="font-medium">Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="font-medium">Description</label>
                    <textarea name="description" class="w-full border rounded p-2"></textarea>
                </div>

                <div>
                    <label class="font-medium">Duration</label>
                    <input type="text" name="duration" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="font-medium">Start Date</label>
                    <input type="date" name="start_date" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="font-medium">Image</label>
                    <input type="file" name="image" class="w-full border rounded p-2">
                </div>

                <button class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Course
                </button>
            </form>
        </div>

    </div>


    <!-- Modal Script -->
    <script>
        function openModal() {
            const modal = document.getElementById('courseModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModal() {
            const modal = document.getElementById('courseModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</body>

</html>
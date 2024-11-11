<x-layout-dashboard>
    <!-- Main Content -->
    <main class="flex-1 ml-64 bg-gray-100 p-4">
        <h1 class="text-3xl font-bold">My Posts</h1>

        <div class="min-h-screen bg-gray-100">
            <section class="bg-white mr-2 rounded-lg shadow-md p-4 min-h-screen">
                <div class="flex justify-start mb-4">
                    <a href="/dashboard/posts" 
                        class="bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-800 font-semibold px-3 py-1 rounded flex items-center space-x-2 transition-colors duration-200">
                        <span class="text-sm">&laquo;</span>
                        <span>Back to all my posts</span>
                    </a>
                </div>
                <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-12 sm:gap-6">
                        <div class="sm:col-span-12">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('title') border-red-500 @enderror" placeholder="" required value="{{ old('title') }}">
                            @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-12">
                            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" name="slug" id="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('slug') border-red-500 @enderror" placeholder="" autocomplete="off" required value="{{ old('slug') }}">
                            @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category_id" name="category_id" required autofocus class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('category_id') border-red-500 @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>    
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Image Upload Field -->
                        <div class="sm:col-span-12">
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" id="image" name="image" class="mt-1 block  rounded-md border-gray-300 shadow-sm @error('image') border-red-500 @enderror" onchange="previewImage()">
                                <img class="img-preview w-40 h-40 object-contain mb-3 rounded-lg col-sm-5" style="display: none;">
                                @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="sm:col-span-12">
                            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white @error('body') border-red-500 @enderror">Body</label>
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                            <trix-editor input="body"></trix-editor>
                            @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Create Post
                    </button>
                </form>
            </section>
        </div>
    </main>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() 
    {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

        function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
        }
    </script>
</x-layout-dashboard>

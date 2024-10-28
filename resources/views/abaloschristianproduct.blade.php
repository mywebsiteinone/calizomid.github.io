<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .active {
            font-weight: bold;
            text-decoration: underline;
            border-bottom: 2px solid white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 flex items-center">
        <div class="text-white text-xl font-bold flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </div>
        <div class="ml-8 flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-home mr-1"></i>
                Dashboard
            </a>
            <a href="{{ route('abalos-users.index') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-users mr-1"></i>
                Users
            </a>
            <a href="{{ route('abalos-categories.index') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-list mr-1"></i>
                Categories
            </a>
            <a href="{{ route('abalos-products.index') }}" class="text-white flex items-center hover:underline active">
                <i class="fas fa-box mr-1"></i>
                Products
            </a>
            <a href="{{ route('abalos.chart') }}" class="text-white flex items-center hover:underline">
    <i class="fas fa-chart-line mr-1"></i>
    Reports
</a>
<a href="{{ route('posts.home') }}" class="text-white flex items-center hover:underline">
    <i class="fas fa-cogs mr-1"></i>
    Manage Post
</a>
        </div>
        <div class="ml-auto flex items-center">
            <span class="text-white mr-4">
                Admin: {{ Auth::user()->name }}
            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>  
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Products</h1>

        <!-- Product Creation/Editing Form -->
        <h2 class="text-xl font-semibold mb-2">{{ isset($editProduct) ? 'Edit Product' : 'Create Product' }}</h2>
        <form action="{{ isset($editProduct) ? route('abalos-products.update', $editProduct->id) : route('abalos-products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-md mb-6">
    @csrf
    @if(isset($editProduct))
        @method('PUT')
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', isset($editProduct) ? $editProduct->name : '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter product name">
    </div>
    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
        <input type="number" id="price" name="price" value="{{ old('price', isset($editProduct) ? $editProduct->price : '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter product price">
    </div>
    <div class="mb-4">
        <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', isset($editProduct) ? $editProduct->stock : '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter stock quantity">
    </div>
    <div class="mb-4">
        <label for="category_id" class="block text-sm font-medium text-gray-700">Category:</label>
        @if($categories->isEmpty())
            <p>No categories available. Please add categories first.</p>
        @else
            <select id="category_id" name="category_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', isset($editProduct) ? $editProduct->category_id : '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
        <input type="file" id="image" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
        @if(isset($editProduct) && $editProduct->image)
            <img src="{{ asset('storage/' . $editProduct->image) }}" alt="Product Image" class="mt-2 w-24 h-24 object-cover">
        @endif
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
        {{ isset($editProduct) ? 'Update' : 'Create' }}
    </button>
</form>


        <!-- Product List -->
        <h2 class="text-xl font-semibold mb-2">Product List:</h2>
        @if($products->count() > 0)
            <div class="overflow-x-auto bg-white rounded shadow-md inline-block">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border">Image</th>
                            <th class="py-2 px-4 border">Name</th>
                            <th class="py-2 px-4 border">Price</th>
                            <th class="py-2 px-4 border">Category</th>
                            <th class="py-2 px-4 border">Stock</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="border-b">
                                <td class="py-2 px-4">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover">
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ $product->name }}</td>
                                <td class="py-2 px-4">${{ number_format($product->price, 2) }}</td>
                                <td class="py-2 px-4">{{ $product->category->name }}</td>
                                <td class="py-2 px-4">{{ $product->stock }}</td>
                                <td class="py-2 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('abalos-products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('abalos-products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-4 text-gray-600">No products found.</p>
        @endif
    </div>

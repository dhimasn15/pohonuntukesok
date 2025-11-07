<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postingan Saya - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .primary { color: #2D4F2B; }
        .bg-primary { background-color: #2D4F2B; }
        .accent { color: #FFAB00; }

        
    </style>
</head>
<body class="bg-gray-50">
    @include('layouts.navigation')
    @include('components.auth-modal')

    <section class="pt-32 pb-20 bg-gradient-to-br from-primary to-green-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Postingan Saya</h1>
                <p class="text-xl text-white/90">Kelola artikel dan tulisan Anda</p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Postingan</h2>
                <a href="{{ route('user.blog.create') }}" 
                   class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-green-800 transition-colors font-semibold">
                    <i class="fas fa-plus mr-2"></i> Buat Post Baru
                </a>
            </div>

            @if($posts->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ Str::limit($post->title, 50) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                        {{ $post->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-1">
                                        @if($post->status === 'published')
                                            @if($post->approval_status === 'approved')
                                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                                    <i class="fas fa-check mr-1"></i> Published
                                                </span>
                                            @elseif($post->approval_status === 'pending')
                                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                                                    <i class="fas fa-clock mr-1"></i> Menunggu Approval
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">
                                                    <i class="fas fa-times mr-1"></i> Ditolak
                                                </span>
                                                @if($post->rejection_reason)
                                                    <span class="text-xs text-gray-500" title="{{ $post->rejection_reason }}">
                                                        Alasan: {{ Str::limit($post->rejection_reason, 30) }}
                                                    </span>
                                                @endif
                                            @endif
                                        @else
                                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">
                                                <i class="fas fa-pencil-alt mr-1"></i> Draft
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $post->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        @if($post->status === 'published' && $post->approval_status === 'approved')
                                            <a href="{{ route('blog.show', $post->slug) }}" 
                                               target="_blank"
                                               class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                                                <i class="fas fa-eye mr-1"></i> Lihat
                                            </a>
                                        @endif
                                        <a href="{{ route('user.blog.edit', $post) }}" 
                                           class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('user.blog.destroy', $post) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
            @else
            <div class="text-center py-12 bg-white rounded-2xl shadow-lg">
                <i class="fas fa-newspaper text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada postingan</h3>
                <p class="text-gray-500 mb-6">Mulai buat postingan pertama Anda</p>
                <a href="{{ route('user.blog.create') }}" 
                   class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-green-800 transition-colors font-semibold">
                    <i class="fas fa-plus mr-2"></i> Buat Post Pertama
                </a>
            </div>
            @endif
        </div>
    </section>

    @include('layouts.footer')
</body>
</html>
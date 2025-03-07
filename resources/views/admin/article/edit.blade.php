@extends('admin.layouts.layout')

@section('admin_content')
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.article.index') }}" class="text-white">Kembali</a>
        <div>
            <h2 class="text-2xl font-semibold text-white">Ubah Artikel</h2>
        </div>
    </div>

    <div>
        @if ($errors->any())
            <div class="bg-red-600 text-white w-full">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.article.update', $article->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-6 gap-x-6">
                <div class="col-span-4 flex flex-col gap-y-3">
                    @livewire('title-slug-component',['title' => $article->title,'slug' => $article->slug])
                    <div class="w-full">
                        <label class="text-white text-sm">Short Title</label>
                        <input type="text" class="w-full px-2 rounded-md h-8" name="short_title" id="short_title"
                               value="{{ $article->short_title }}"/>
                    </div>
                    <div class="w-full">
                        <label class="text-white text-sm">Short Description</label>
                        <textarea id="short-description" class="w-full rounded-md"
                                  name="short_description">{{ $article->short_description }}</textarea>
                    </div>
                    <div class="w-full">
                        <label class="text-white text-sm">Description</label>
                        <textarea id="description" class="w-full rounded-md"
                                  name="description">{{ $article->description }}</textarea>
                    </div>
                </div>
                <div class="col-span-2 flex flex-col gap-y-3">
                    <div class="w-full">
                        <label class="text-white text-sm">Language</label>
                        <input type="text" class="w-full px-2 rounded-md h-8" name="language" id="language"
                               value="id" readonly/>
                    </div>
                    <div class="w-full flex flex-col">
                        <label class="text-white text-sm">Category</label>
                        <select class="" multiple="multiple" name="categories[]" id="categories">
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $article->categories) ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full flex flex-col">
                        <label class="text-white text-sm">Tags</label>
                        <select class="form-control" multiple="multiple" name="tags[]" id="tags">
                            @foreach($tags as $item)
                                <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $article->tags) ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <a href="{{ 'https://artiknesia.com/admin/'. $article->image }}" target="_blank">
                            <img src="{{ 'https://artiknesia.com/admin/'. $article->image }}" alt="{{ $article->image_caption }}"
                                 class="object-cover h-52 w-full"/>
                        </a>
                        <label class="text-white text-sm">Image</label>
                        <input type="file" class="w-full rounded-md h-8 bg-white px-2 py-1 text-xs" name="image"
                               id="image"/>
                    </div>
                    <div class="w-full">
                        <label class="text-white text-sm">Image Caption</label>
                        <input type="text" class="w-full px-2 rounded-md h-8" name="image_caption" id="image-caption"
                               value="{{ $article->image_caption }}"/>
                    </div>
                    <div class="w-full flex flex-col">
                        <label class="text-white text-sm">Status</label>
                        <select name="status" id="status">
                            <option value="publish" @selected($article->status === 'publish')>Publish</option>
                            <option value="archive" @selected($article->status === 'archive')>Archive</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="text-white text-sm">Meta Title</label>
                        <input type="text" class="w-full px-2 rounded-md h-8" name="meta_title" id="meta-title"
                               value="{{ $article->meta_title }}"/>
                    </div>
                    <div class="w-full">
                        <label class="text-white text-sm">Meta Description</label>
                        <input type="text" class="w-full px-2 rounded-md h-8" name="meta_description"
                               id="meta-description" value="{{ $article->meta_description }}"/>
                    </div>
                    <div class="w-full flex flex-col">
                        <label class="text-white text-sm">Meta Robot</label>
                        <select name="meta_robots" id="meta_robots">
                            <option value="index, follow" @selected($article->meta_robots === 'index, follow')>index,
                                follow (default)
                            </option>
                            <option value="noindex, follow" @selected($article->meta_robots === 'noindex, follow')>
                                noindex, follow
                            </option>
                            <option value="index, nofollow" @selected($article->meta_robots === 'index, nofollow')>
                                index, nofollow
                            </option>
                            <option value="noindex, nofollow" @selected($article->meta_robots === 'noindex, nofollow')>
                                noindex, nofollow
                            </option>
                            <option value="noarchive" @selected($article->meta_robots === 'noarchive')>noarchive
                            </option>
                            <option value="nosnippet" @selected($article->meta_robots === 'nosnippet')>nosnippet
                            </option>
                            <option value="noimageindex" @selected($article->meta_robots === 'noimageindex')>
                                noimageindex
                            </option>
                            <option value="none" @selected($article->meta_robots === 'none')>none (noindex, nofollow)
                            </option>
                            <option value="notranslate" @selected($article->meta_robots === 'notranslate')>notranslate
                            </option>
                        </select>
                    </div>
                    <div class="w-full">
                        <button type="submit" class="bg-blue-600 text-white rounded-md px-3 py-1 w-full">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('custom-js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('textarea').each(function () {
                let id = $(this).attr('id')
                CKEDITOR.ClassicEditor.create(document.querySelector(`#${id}`), {
                    toolbar: {
                        items: [
                            "findAndReplace", "selectAll", "|",
                            "heading", "|",
                            "fontSize", "fontFamily", "fontColor", "fontBackgroundColor", "highlight", "|",
                            "bulletedList", "numberedList", "todoList", "|",
                            "outdent", "indent", "|",
                            "undo", "redo", "|",
                            "specialCharacters", "horizontalLine", "|",
                            "link", "insertImage", "blockQuote", "insertTable", "mediaEmbed",
                            "-",
                            "alignment", "|",
                            "bold", "italic", "strikethrough", "underline", "code", "subscript", "superscript",
                            "removeFormat", "|",
                            "exportPDF", "exportWord", "|",
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    removePlugins: [
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        'MathType',
                        'WebSocketGateway'
                    ],
                    ckfinder: {
                        uploadUrl: "{{ route('admin.article.image.upload') }}?_token={{ csrf_token() }}",
                        options: {
                            resourceType: 'Images'
                        }
                    },
                    mediaEmbed: {
                        previewsInData: true
                    }
                }).then(editor => {
                    window.editor = editor;
                    // editor.model.document.on('change:data', () => {
                    //     document.querySelector('#hidden-materi').value = editor.getData();
                    // });
                }).catch(error => {
                    console.error(error);
                });
            })
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('select').select2({
                minimumResultsForSearch: -1
            });
            $('select[multiple]').select2({
                tags: true, // Allow users to create new tags
                tokenSeparators: [',', ' '], // Split tags by comma or space
                createTag: function (params) {
                    let term = $.trim(params.term);

                    if (term === '') {
                        return null; // Avoid empty tags
                    }

                    return {
                        id: 'new-' + term, // Unique tag ID using timestamp
                        text: term,
                        newTag: true // Mark the tag as newly created
                    };
                }
            });
        });
    </script>
@endsection
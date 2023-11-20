@extends('frontend.layouts.pages-layout')
@push('stylesheets')
    <!-- Bootstrap (https://github.com/twbs/bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Feather icons (https://github.com/feathericons/feather) -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Vue (https://github.com/vuejs/vue) -->
    @if (config('app.debug'))
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @endif

    <!-- Axios (https://github.com/axios/axios) -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Sortable (https://github.com/SortableJS/Sortable) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
    <!-- Vue.Draggable (https://github.com/SortableJS/Vue.Draggable) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.23.2/vuedraggable.umd.min.js"></script>

    <style>
        textarea
        {
            min-height: 200px;
        }

        table tr td
        {
            white-space: nowrap;
        }

        a
        {
            text-decoration: none;
        }

        .deleted
        {
            opacity: 0.65;
        }

        #main
        {
            padding: 2em;
        }

        .shadow-sm
        {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card.category
        {
            margin-bottom: 1em;
        }

        .list-group .list-group
        {
            min-height: 1em;
            margin-top: 1em;
        }

        .btn svg.feather
        {
            width: 16px;
            height: 16px;
            stroke-width: 3px;
            vertical-align: -2px;
        }

        .modal-title svg.feather
        {
            margin-right: .5em;
            vertical-align: -3px;
        }

        .category .subcategories
        {
            background: #fff;
        }

        .category > .list-group-item
        {
            z-index: 1000;
        }

        .category .subcategories .list-group-item:first-child
        {
            border-radius: 0;
        }

        .timestamp
        {
            border-bottom: 1px dotted var(--bs-gray);
            cursor: help;
        }

        .fixed-bottom-right
        {
            position: fixed;
            right: 0;
            bottom: 0;
        }

        .fade-enter-active, .fade-leave-active
        {
            transition: opacity .3s;
        }
        .fade-enter, .fade-leave-to
        {
            opacity: 0;
        }

        .mask
        {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(50, 50, 50, .2);
            opacity: 0;
            transition: opacity .2s ease;
            z-index: 1020;
        }
        .mask.show
        {
            opacity: 1;
        }

        .form-check
        {
            user-select: none;
        }

        .sortable-chosen
        {
            background: var(--bs-light);
        }

        @media (max-width: 575.98px)
        {
            #main
            {
                padding: 1em;
            }
        }
    </style>
@endpush
@section('pageTitle')
    @if (isset($thread_title))
        {{ $thread_title }} —
    @endif
    @if (isset($category))
        {{ $category->title }} —
    @endif
    {{ trans('forum::general.home_title') }}
@endsection
@section('content')
    <div id="main" class="container">
        @include('forum.partials.breadcrumbs')
        @include('forum.partials.alerts')

        @yield('content')
    </div>

    <div class="mask"></div>

    @yield('footer')
@endsection
@push('scripts')
    
<script>
    const mask = document.querySelector('.mask');

    function findModal (key)
    {
        const modal = document.querySelector(`[data-modal=${key}]`);

        if (! modal) throw `Attempted to open modal '${key}' but no such modal found.`;

        return modal;
    }

    function openModal (modal)
    {
        modal.style.display = 'block';
        mask.style.display = 'block';
        setTimeout(function()
        {
            modal.classList.add('show');
            mask.classList.add('show');
        }, 200);
    }

    document.querySelectorAll('[data-open-modal]').forEach(item =>
    {
        item.addEventListener('click', event =>
        {
            event.preventDefault();

            openModal(findModal(event.currentTarget.dataset.openModal));
        });
    });

    document.querySelectorAll('[data-modal]').forEach(modal =>
    {
        modal.addEventListener('click', event =>
        {
            if (! event.target.hasAttribute('data-close-modal')) return;

            modal.classList.remove('show');
            mask.classList.remove('show');
            setTimeout(function()
            {
                modal.style.display = 'none';
                mask.style.display = 'none';
            }, 200);
        });
    });

    document.querySelectorAll('[data-dismiss]').forEach(item =>
    {
        item.addEventListener('click', event => event.currentTarget.parentElement.style.display = 'none');
    });
</script>
@endpush
    {{-- <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav> --}}
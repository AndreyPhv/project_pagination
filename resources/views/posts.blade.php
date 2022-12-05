@extends('layouts.main')

@section('body')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
        </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="/posts/page/1">First</a></li>
                @foreach($pagination_pages as $page)
                    @if($page == $current_page)
                        <li class="page-item active"><a class="page-link" href="/posts/page/{{$page}}">{{$page}}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="/posts/page/{{$page}}">{{$page}}</a></li>
                    @endif
                @endforeach
                <li class="page-item"><a class="page-link" href="/posts/page/{{$page_count}}">Last</a></li>
            </ul>
        </nav>
    </div>

@endsection

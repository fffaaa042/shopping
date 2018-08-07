@extends('layouts.admin')

@section('content')
    @if(count($posts)>0)
    <h1>All Posts</h1>

    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>

           @foreach($posts as $post)
             <tr>
                 <td>{{$post->id}}</td>
                 <td><img height="40" src="{{$post->photo ? $post->photo->file : 'images/no-photo.png'}}" alt=""></td>
                 <td>{{$post->user->name}}</td>
                 <td>{{$post->category ? $post->category->name : 'uncategorized'}}</td>
                 <td>{{$post->title}}</td>
                 <td>{{$post->created_at->diffForHumans()}}</td>
                 <td>{{$post->updated_at->diffForHumans()}}</td>
             </tr>
           @endforeach

         @else <!--else count if-->
             <h1>No Posts</h1>
         @endif <!--End count if-->
       </tbody>
     </table>
@stop
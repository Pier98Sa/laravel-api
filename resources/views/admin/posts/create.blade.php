@extends('admin.layouts.base')
@section('pageTitle', 'BoolPress - Nuovo Post')
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h1 class="text-center">Crea un nuovo post </h1>

              <form method="POST" action="{{ route('admin.posts.store') }}">
                @csrf
                <div class="form-group">
                  <label for="title">Titolo</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>

                <div class="form-group">
                  <label for="author">Autore</label>
                  <input type="text" class="form-control" id="author" name="author" value="{{old('author')}}">
                </div>

                <div class="form-group">
                  <label for="category_id">Categoria</label>
                  <select id="category_id" name="category_id" class="form-control">
                    <option value="">Nessuna categoria selezionata</option>
                    @foreach ($categories as $category)
                      <option {{old('category_id') == $category->id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="content">Contenuto del post</label>
                  <textarea class='form-control' name="content" id="content" cols="30" rows="10"> {{old('content')}}</textarea>
                </div>

                @foreach ($tags as $tag)
                  <div class="custom-control custom-checkbox">
                    <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{in_array($tag->id, old('tags',[]))? 'checked': ''}}       >
                    <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                  </div>
                  
                @endforeach

                <button type="submit" class="btn btn-primary">Salva</button>
              </form>

          </div>
      </div>
  </div>
@endsection
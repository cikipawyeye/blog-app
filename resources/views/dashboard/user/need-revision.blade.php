@extends('dashboard.layouts.app')

@section('title', 'Drafts')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- <h6>Revision table</h6> --}}
                    <span class="badge badge-sm bg-gradient-warning">Revision</span>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      @if (count($posts) > 0)
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Category</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Note
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <h6 class="ps-3 mb-0 text-sm"><a
                                                    href="/dashboard/need-revisions/{{ $post->slug }}">{{ $post->title }}</a>
                                            </h6>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{!! $post->category->name ?? '<span class="text-danger">Uncategorized</span>' !!}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ Str::limit($post->revision_note, 30, '...') }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $post->updated_at }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/posts/{{ $post->id }}/edit"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      @else
                        <h4 class="text-center my-5">Nothing here..</h4>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

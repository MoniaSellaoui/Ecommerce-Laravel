<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset('dashassets//img/favicons/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('dashassets/favicons/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('dashassets/img/favicons/favicon-16x16.png') }}>
    <link rel="shortcut icon" type="image/x-icon" href={{ asset('dashassets/img/favicons/favicon.ico') }}>
    <link rel="manifest" href={{ asset('dashassets/img/favicons/manifest.json') }}>
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href={{ asset('dashassets/css/phoenix.min.css') }} rel="stylesheet" id="style-default">
    <link href={{ asset('dashassets/css/user.min.css') }} rel="stylesheet" id="user-style-default">
    <style>
        body {

            opacity: 0;
        }
    </style>
</head>

<body>


    <main class="main" id="top">
        <div class="container-fluid px-0">

            <!--include sidebar et navbar-->
            @include('inc.Admin.sidebar')
            @include('inc.Admin.navbar')

            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <div>
                            <h1>Liste des Produits</h1>
                            <hr>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Ajouer
                                Produits</a>

                            <div class="mt-2">
                                <form action="/Admin/products/search" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="product_name"
                                                placeholder="nom de produit rechercher">
                                        </div>
                                        <div class="col-5">
                                            <input type="number" class="form-control" name="qte"
                                                placeholder="qte de produit rechercher">
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-primary">search</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description </th>
                                    <th scope="col">price </th>
                                    <th scope="col">quantité</th>
                                    <th scope="col">photo</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produits as $index => $P)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $P->name }}</td>
                                        <td>{{ $P->description }}</td>
                                        <td>{{ $P->price }}</td>
                                        <td>{{ $P->qte }}</td>

                                        <td>
                                            <img src="{{ asset('uploads') }}/{{ $P->photo }}" width="200"
                                                alt="" />
                                        </td>

                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#editProduct{{ $P->id }}"
                                                class="btn btn-success">Modifier</a>
                                            <a onclick="return confirm('voulez-vous vraiment supprimer cette produits?')"
                                                href="/Admin/products/{{ $P->id }}/delete"
                                                class="btn btn-danger">supprimer</a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>




                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>

    <!--modal d ajout-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter produits</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fas fa-times fs--1"></span></button>
                </div>
                <form action="/Admin/products/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">



                        <div class="mb-3">


                            <label class="form-label" for="exampleFormControlInput1">Nom </label>
                            <input name="name" class="form-control" id="exampleFormControlInput1" type="text"
                                placeholder="tapper nom produit">

                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label" for="exampleTextarea">description</label>
                            <textarea name="description" class="form-control" rows="3"> </textarea>

                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">

                            <label class="form-label" for="exampleFormControlInput1">Price</label>
                            <input name="price" class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder="tapper prix produit">

                            @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <label class="form-label" for="exampleFormControlInput1">Quantité</label>
                            <input name="qte" class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder="tapper quantité produit">

                            @error('quantité')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <label class="form-label" for="exampleFormControlInput1">photo</label>
                            <input name="photo" class="form-control" id="exampleFormControlInput1" type="file"
                                placeholder="image produit">

                            @error('photo')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">


                            <label class="form-label" for="exampleFormControlInput1">Nom categorie </label>
                            <select name="categorie" class="form-control">
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>

                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Okay</button>
                        <button class="btn btn-outline-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @foreach ($produits as $index => $P)
        <!--modal modifier-->
        <div class="modal fade" id="editProduct{{ $P->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier Produit:<span
                                class="text primary">{{ $P->name }}</span></h5>
                        <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                class="fas fa-times fs--1"></span></button>
                    </div>
                    <form action="/Admin/products/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="idproduit" value="{{ $P->id }}" />

                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">Modifier
                                    Produit</label>
                                <input name="name" class="form-control" id="exampleFormControlInput1"
                                    type="text" value="{{ $P->name }}" placeholder="tapper nom produit">

                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-0">
                                <label class="form-label" for="exampleTextarea">description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $P->description }} </textarea>

                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">price
                                </label>
                                <input name="price" class="form-control" id="exampleFormControlInput1"
                                    type="number" value="{{ $P->price }}" placeholder="tapper prix produit">

                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">quantité
                                </label>
                                <input name="qte" class="form-control" id="exampleFormControlInput1"
                                    type="number" value="{{ $P->qte }}" placeholder="tapper quantité">

                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">photo</label>
                                <input name="photo" class="form-control" id="exampleFormControlInput1"
                                    type="file" placeholder="image produit">

                                @error('photo')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                            <button class="btn btn-outline-primary" type="button"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <script src={{ asset('dashassets/js/phoenix.js') }}></script>
    <script src={{ asset('dashassets/js/ecommerce-dashboard.js') }}></script>
</body>

</html>

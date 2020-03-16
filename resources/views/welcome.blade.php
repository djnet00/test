<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row">


            <div class="container">

                <main class="col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
                    <h1 class="bd-title" id="content">rootstack TEST</h1>

                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <label for="age">Please enter the age:&nbsp;&nbsp;</label>
                            <input type="text" class="form-control" id="age" name="age" value="{{ request()->get('age', 20) }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search <i class="fa fa-search"></i></button>
                    </form>

                    <hr />

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Fetch &amp; order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Fetch &amp; find</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Fetch &amp; count</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>NAME</th>
                                    <th>AGE</th>
                                    <th>EMAIL</th>
                                    <th>CITY</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $persons as $person )
                                    <tr>
                                        <td><img class="img-thumbnail" src="{{ $person['picture']['medium'] }}" /></td>
                                        <td>{{ $person['name'] }}</td>
                                        <td>{{ $person['age'] }}</td>
                                        <td>{{ $person['email'] }}</td>
                                        <td>{{ $person['location']['city'] }} - {{ $person['location']['country'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br />
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $filterAge['picture']['large'] }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $filterAge['name'] }}</h5>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">AGE: {{ $filterAge['age'] }}</li>
                                    <li class="list-group-item">E-MAIL: {{ $filterAge['email'] }}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="#" class="card-link">LOCATION:</a>
                                    <a href="#" class="card-link">{{ $filterAge['location']['city'] }} - {{ $filterAge['location']['country'] }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <br />

                            <div class="alert alert-warning" role="alert">
                                <strong>Char: </strong> {{ $countChars['letter'] }}
                                <br />
                                <strong>Count: </strong> {{ $countChars['count'] }}
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>NAME</th>
                                        <th>AGE</th>
                                        <th>EMAIL</th>
                                        <th>CITY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $countChars['persons'] as $person )
                                    <tr>
                                        <td><img class="img-thumbnail" src="{{ $person['picture']['medium'] }}" /></td>
                                        <td>{!! str_replace( $countChars['letter'], "<mark>{$countChars['letter']}</mark>", strtoupper($person['name']) ) !!}</td>
                                        <td>{{ $person['age'] }}</td>
                                        <td>{{ $person['email'] }}</td>
                                        <td>{{ $person['location']['city'] }} - {{ $person['location']['country'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </main>

            </div>
        </div>
    </body>
</html>

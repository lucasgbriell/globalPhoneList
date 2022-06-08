<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Global Agenda</title>
    <link rel="stylesheet" href="css/main.css">

    <!-- Vendor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
        <div class="content">
            <h1 class="text-white">
                <i class="fa-solid fa-address-book"></i>
                Global Phone List
            </h1>
        </div>
    </header>

    <main>

        <section>
            <div class="content float-div">
                <form action="{{route('customer.store')}}" method="POST" class="form form-grid col-3" id="form">
                    @csrf
                    <div class="group">
                        <input type="text" placeholder="Customer name *" name="name" id="" required>
                    </div>
                    <div class="groups">
                        <div class="group-row">
                            <select name="countryCode" id="">
                                @foreach(\App\Models\Customer::FLAGS as $code => $flag)
                                    <option value="({{$code}})">{{$flag}} + {{$code}}</option>
                                @endforeach
                            </select>
                            <input type="text" placeholder="Phone number" name="phone" id="" required>
                        </div>
                    </div>
                    <div class="group">
                        <button type="submit" class="submit">Save</button>
                    </div>
                </form>
            </div>
        </section>

        <section>
            <div class="content margin-top-3">
                <h2 class="title">Filter registers</h2>
            </div>
            <div class="content margin-top-1">
                <form method="GET" class="form-grid col-4 width-100">
               
                    <input type="text" placeholder="Customer name *" name="name" id="" value="{{request()->input('name')}}">
    
                    <select name="countryCode" id="">
                        <option value="">By Country</option>
                        @foreach(\App\Models\Customer::FLAGS as $code => $flag)
                            <option value="({{$code}})" @if(request()->input('countryCode') == "({$code})") selected @endif>{{$flag}} + {{$code}}</option>
                        @endforeach
                    </select>

                    <select name="status" id="">
                        <option value="">By Status</option>
                        <option value="valid" @if(request()->input('status') == 'valid') selected @endif>Valid</option>
                        <option value="invalid" @if(request()->input('status') == 'invalid') selected @endif>Invalid</option>
                    </select>
    
                    <button type="submit"><i class="fa-solid fa-filter"></i> Filter</button>
  
                </form>
            </div>
            <div class="content margin-top-1">
                <table>
                    <thead>
                        <tr>
                            <th width="45%">Customer</th>
                            <th>Country Code</th>
                            <th>Phone Number</th>
                            <th>Valid Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
              
                            @if(!$customers->isEmpty())

                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->getFlag()}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>
                                            @if($customer->isValid())
                                                <i class="fa-solid fa-circle-check success"></i> Valid
                                            @else
                                                <i class="fa-solid fa-circle-xmark danger"></i> Invalid
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('customer.delete', $customer->id)}}">
                                               Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center">No data founded</td>
                                </tr>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="content margin-y-2">
          
            </div>
        </section>

    </main>

<script src="js/main.js"></script>
</body>
</html>
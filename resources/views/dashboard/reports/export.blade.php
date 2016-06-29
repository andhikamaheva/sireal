<html>
<head>
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <title>Export Data Calon Asisten Lab</title>

</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 40px;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="row" style="border-bottom: 2px solid #000000">
                        <div class="col-md-2">
                            <img src="{{asset('assets/global/img/stikom.png')}}" style="max-width:150px;"/>
                        </div>
                        <div class="col-md-8" style="text-align: center">
                            <h4>Institut Bisnis dan Informatika Stikom Surabaya</h4>
                            <h5>Laboratorium Komputer</h5>
                            <h5>Jalan Raya Kedung Baruk No. 98, Surabaya</h5>
                            <h5>website: www.stikom.edu email: info@stikom.edu</h5>
                        </div>
                        <div class="col-md-2">
                            <img src="{{asset('assets/global/img/labkom.png')}}" style="max-width:70px;"/>
                        </div>
                    </div>

                    <div class="row" style="padding-top:10px;">
                        <div class="col-md-12" style="text-align: center">
                            <h5>Seleksi Penerimaan Asisten Labkom</h5>
                            <h5>{{$subject}}</h5>
                        </div>
                    </div>
                    <div class="row" style="padding-top:10px;">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Mata Praktikum</th>
                                <th>Total Score</th>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$student['nim']}}</td>
                                        <td>{{$student['name']}}</td>
                                        <td>{{$student['subject']}}</td>
                                        <td>{{$student['score']}}</td>

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
</body>
</html>
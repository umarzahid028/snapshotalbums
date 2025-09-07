@include('layouts.admin.header_new')

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="thing">
                    
                    <input type="submit" value="upload" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</body>
@include('layouts.admin.footer_new')
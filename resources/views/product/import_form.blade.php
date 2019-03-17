<!-- Import Excel file -->
<div class="modal fade" id="importFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalCenterTitle">Import excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="file" class="form-control-file" id="FormControlFile">
                    </div>
                    <hr>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Wykonaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
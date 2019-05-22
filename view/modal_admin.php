
<div class='container my-container-padding my-container-border my-container-margin my-container-color-white'>
    <div class='container my-container-color-white' id='nuova_sezione'>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_sezione">
        Crea nuova sezione
        </button>
    </div>
</div>


<div id="modal_sezione" name="modal_sezione" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuova sezione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="nome_materia" class="col-sm-2 col-form-label">Titolo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome_materia"  name="nome_materia" placeholder="nome materia" required>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
            <label id="err" class="errorMsg">La sezione esiste gia! Forse e' stata disabilitata?</label>
                <button type="button" id="nuova_sezione" name="nuova_sezione" class="btn btn-secondary">Crea nuova sezione</button>
                <button type="button" id="close" name="close" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            </div>
            </div>
        </div>
        </div>
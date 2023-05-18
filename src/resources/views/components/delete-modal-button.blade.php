<button type="button"
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal">
    Удалить
</button>
<div class="modal fade"
     id="deleteModal"
     tabindex="-1"
     aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="deleteModalLabel">
                    Предупреждение</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $question }}
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Отмена
                </button>
                <form method="POST" action="{{ $route }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

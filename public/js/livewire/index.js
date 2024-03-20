// update

document.addEventListener("livewire:navigated", function () {
    initFlowbite();
    $(".modal-backdrop.show").remove();
    const modal = document.querySelector("#kt_modal_update");
    if (modal) {
        modal.addEventListener("show.bs.modal", (e) => {
            $(".modal-backdrop.show").remove();
            Livewire.dispatch("update", {
                id: e.relatedTarget.getAttribute("data-id"),
            });
        });
    }
});
document.addEventListener("livewire:navigated", function () {
    $(".modal-backdrop.show").remove();
    const modal = document.querySelector("#kt_modal_update1");
    if (modal) {
        modal.addEventListener("show.bs.modal", (e) => {
            $(".modal-backdrop.show").remove();
            Livewire.dispatch("update", {
                id: e.relatedTarget.getAttribute("data-id"),
            });
        });
    }
});

document.addEventListener("livewire:init", function () {
    Livewire.on("success", function (success) {
        $("#kt_modal_add").modal("hide");
        $("#kt_modal_update").modal("hide");
        toastr.options = {
            closeButton: true,
            progressBar: true,
        };
        toastr.success(success);
    });
});

document.addEventListener("livewire:init", function () {
    Livewire.on("error", function (error) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
        };
        toastr.error(error);
    });
});


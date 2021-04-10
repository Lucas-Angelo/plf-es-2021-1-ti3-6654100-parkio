const handleEntranceFormSubmit = (event) => {
    event.preventDefault();

    const plate = document.querySelector("#input-plate").value;
    const driverName = document.querySelector("#input-name").value;
    const destinationId = document.querySelector("#selDestination").value;
    let categoryId = document.querySelector("#input-type").value;
    if (categoryId.length === 0) categoryId = 1;
    let time = document.querySelector("#input-time").value;
    if (!time) time = categoryId == 1 ? 60 : 120;
    const model = document.querySelector("#input-model").value;
    const cpf = document.querySelector("#input-cpf").value;
    const color = document.querySelector("#input-color").value;
    const gateId = 1;

    const data = {
        plate,
        driverName,
        destinationId: +destinationId,
        categoryId,
        time,
        model,
        cpf,
        color,
        gateId,
    };
    fetch("/api/vehicles/save", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((res) => {
            if (res.status !== 200) {
            } else {
                document.getElementById("entrance-form").reset();
            }
        })
        .catch((err) => {
            console.log(err);
        });
};

window.addEventListener("load", function () {
    $(".select2").select2({
        selectionCssClass: "gate-select2",
        ajax: {
            url: "/api/destinations",
            data: function (params) {
                var query = {
                    search: params.term,
                };
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (res) {
                let destiniesArray = [];
                res.data.forEach((item, index) => {
                    destiniesArray.push({
                        id: item.id,
                        text: item.block + " " + item.apartament
                    })
                });
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: destiniesArray,
                };
            },
        },
    });
});

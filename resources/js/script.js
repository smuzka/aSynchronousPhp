
addEventListener("load", () => {
    const asyncButton = document.querySelector(".async-button")
    asyncButton?.addEventListener("click", async () => {
        const response = fetch("getApi");
        console.log("test button");
        // const translation = await response.json();
        // console.log(translation);
    })

    Echo.channel('getApi')
        .listen('getApi', (e) => {
            alert("test echo");
            console.log(e);
        })
})

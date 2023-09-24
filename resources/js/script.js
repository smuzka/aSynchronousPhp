
addEventListener("load", () => {
    const asyncButton = document.querySelector(".a-sync-button")
    let imagesCounter;
    let asyncTimeStart;
    asyncButton?.addEventListener("click", async () => {
        const response = fetch("getApi");
        imagesCounter = 0;
        asyncTimeStart = Date.now();
    })

    Echo.channel('getApiChannel')
        .listen('getApiEvent', (e) => {
            console.log(e);
            imagesCounter++;
            if (imagesCounter === 15) {
                console.log("Asynchronous get: " + (Date.now() - asyncTimeStart) / 1000 + "s");
            }
        })

    const syncButton = document.querySelector(".sync-button")
    let syncTimeStart;
    syncButton?.addEventListener("click", async () => {
        syncTimeStart = Date.now();
        const response = await fetch("getApiSynchronously");
        const data = await response.json();
        console.log(data);
        console.log("Synchronous get: " + (Date.now() - syncTimeStart) / 1000 + "s");
    })

    const promisesButton = document.querySelector(".promises-button");
    let promisesTimeStart = Date.now();
    promisesButton?.addEventListener("click", async () => {
        promisesTimeStart = Date.now();
        const response = await fetch("getApiPromises");
        const data = await response.json();
        console.log(data);
        console.log("Promises get: " + (Date.now() - promisesTimeStart) / 1000 + "s");
    })
})

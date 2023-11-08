
addEventListener("load", () => {

    const AsynchronousApiHandler = () => {
        const ApiAsyncButton = document.querySelector(".a-sync-button-api")
        let asyncImagesCounter = 0;
        let ApiAsyncTimeStart;
        ApiAsyncButton?.addEventListener("click", async () => {
            const response = fetch("getApiAsynchronously");
            asyncImagesCounter = 0;
            ApiAsyncTimeStart = Date.now();
        })

        Echo.channel('asyncChannel')
            .listen('getApiEvent', (e) => {
                console.log((Date.now() - ApiAsyncTimeStart) / 1000 + "s");
                asyncImagesCounter++;
                if (asyncImagesCounter === 15) {
                    console.log("Api Asynchronous get: " + (Date.now() - ApiAsyncTimeStart) / 1000 + "s");
                }
            })
    }

    const SynchronousApiHandler = () => {
        const ApiSyncButton = document.querySelector(".sync-button-api")
        let synchronousImagesCounter = 0;
        let ApiSyncTimeStart;
        ApiSyncButton?.addEventListener("click", async () => {
            const response = fetch("getApiSynchronously");
            synchronousImagesCounter = 0;
            ApiSyncTimeStart = Date.now();
        })

        Echo.channel('syncChannel')
            .listen('sendMessageEvent', (e) => {
                console.log((Date.now() - ApiSyncTimeStart) / 1000 + "s");
                synchronousImagesCounter++;
                if (synchronousImagesCounter === 15) {
                    console.log("Api Synchronous get: " + (Date.now() - ApiSyncTimeStart) / 1000 + "s");
                }
            })

        // ApiSyncButton?.addEventListener("click", async () => {
        //     ApiSyncTimeStart = Date.now();
        //     const response = await fetch("getApiSynchronously");
        //     const data = await response.json();
        //     console.log(data);
        //     console.log("Api Synchronous get: " + (Date.now() - ApiSyncTimeStart) / 1000 + "s");
        // })
    }

    const PromisesApiHandler = () => {
        const promisesButton = document.querySelector(".promises-button-api");
        let promisesTimeStart = Date.now();
        promisesButton?.addEventListener("click", async () => {
            promisesTimeStart = Date.now();
            const response = await fetch("getApiPromises");
            const data = await response.json();
            console.log(data);
            console.log("Promises get: " + (Date.now() - promisesTimeStart) / 1000 + "s");
        })
    }

    const AsynchronousDBHandler = () => {
        const DBAsyncButton = document.querySelector(".a-sync-button-db")
        let queryCounter = 0;
        let DBAsyncTimeStart;
        DBAsyncButton?.addEventListener("click", async () => {
            const response = fetch("getDBAsynchronously");
            queryCounter = 0;
            DBAsyncTimeStart = Date.now();
        })

        Echo.channel('asyncChannel')
            .listen('getDBEvent', (e) => {
                console.log(e);
                queryCounter++;
                if (queryCounter === 10) {
                    console.log("DB Asynchronous get: " + (Date.now() - DBAsyncTimeStart) / 1000 + "s");
                }
            })
    }

    const SynchronousDBHandler = () => {
        const DBSyncButton = document.querySelector(".sync-button-db")
        let DBSyncTimeStart;
        DBSyncButton?.addEventListener("click", async () => {
            DBSyncTimeStart = Date.now();
            const response = await fetch("getDBSynchronously");
            const data = await response.json();
            console.log(data);
            console.log("DB Synchronous get: " + (Date.now() - DBSyncTimeStart) / 1000 + "s");
        })
    }

    const AsynchronousMailHandler = () => {

    }

    const SynchronousMailHandler = () => {
        const MailSyncButton = document.querySelector(".sync-button-mail")
        let MailSyncTimeStart;
        MailSyncButton?.addEventListener("click", async () => {
            MailSyncTimeStart = Date.now();
            const response = await fetch("getMailSynchronously");
            const data = await response.json();
            console.log(data);
            console.log("Mail Synchronous get: " + (Date.now() - MailSyncTimeStart) / 1000 + "s");
        })
    }

    AsynchronousApiHandler();
    AsynchronousDBHandler();
    AsynchronousMailHandler();
    SynchronousApiHandler();
    SynchronousDBHandler();
    SynchronousMailHandler();
    PromisesApiHandler();
})

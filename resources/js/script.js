
addEventListener("load", () => {

    const AsynchronousApiHandler = () => {
        const ApiAsyncButton = document.querySelector(".a-sync-button-api")
        let asyncImagesCounter = 0;
        let ApiAsyncTimeStart;
        ApiAsyncButton?.addEventListener("click", async () => {
            asyncImagesCounter = 0;
            ApiAsyncTimeStart = Date.now();
            const response = fetch("getApiAsynchronously");
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
            synchronousImagesCounter = 0;
            ApiSyncTimeStart = Date.now();
            const response = fetch("getApiSynchronously");
        })

        Echo.channel('syncChannel')
            .listen('sendMessageEvent', (e) => {
                console.log((Date.now() - ApiSyncTimeStart) / 1000 + "s");
                synchronousImagesCounter++;
                if (synchronousImagesCounter === 15) {
                    console.log("Api Synchronous get: " + (Date.now() - ApiSyncTimeStart) / 1000 + "s");
                }
            })
    }

    const PromisesApiHandler = () => {
        const promisesButton = document.querySelector(".promises-button-api");
        let promisesImagesCounter = 0;
        let ApiPromisesTimeStart;
        promisesButton?.addEventListener("click", async () => {
            ApiPromisesTimeStart = Date.now();
            promisesImagesCounter = 0;
            const response = await fetch("getApiPromises");
        })

        Echo.channel('asyncChannel')
            .listen('promisesMessageEvent', (e) => {
                console.log((Date.now() - ApiPromisesTimeStart) / 1000 + "s");
                promisesImagesCounter++;
                if (promisesImagesCounter === 15) {
                    console.log("Api Promises get: " + (Date.now() - ApiPromisesTimeStart) / 1000 + "s");
                }
            })
    }

    const AsynchronousDBHandler = () => {
        const DBAsyncButton = document.querySelector(".a-sync-button-db")
        let queryCounter = 0;
        let DBAsyncTimeStart;
        DBAsyncButton?.addEventListener("click", async () => {
            DBAsyncTimeStart = Date.now();
            queryCounter = 0;
            const response = fetch("getDBAsynchronously");
        })

        Echo.channel('asyncChannel')
            .listen('getDBEvent', (e) => {
                console.log((Date.now() - ApiPromisesTimeStart) / 1000 + "s");

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

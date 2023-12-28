
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
                console.log((Date.now() - DBAsyncTimeStart) / 1000 + "s");

                queryCounter++;
                if (queryCounter === 10) {
                    console.log("DB Asynchronous get: " + (Date.now() - DBAsyncTimeStart) / 1000 + "s");
                }
            })
    }

    const SynchronousDBHandler = () => {
        const DBSyncButton = document.querySelector(".sync-button-db")
        let syncQueryCounter = 0;
        let DBSyncTimeStart;

        DBSyncButton?.addEventListener("click", async () => {
            DBSyncTimeStart = Date.now();
            syncQueryCounter = 0;
            const response = fetch("getDBSynchronously");
        })

        Echo.channel('asyncChannel')
            .listen('getDBSyncEvent', (e) => {
                console.log((Date.now() - DBSyncTimeStart) / 1000 + "s");

                syncQueryCounter++;
                if (syncQueryCounter === 10) {
                    console.log("DB Synchronous get: " + (Date.now() - DBSyncTimeStart) / 1000 + "s");
                }
            })
    }

    const AsynchronousMailHandler = () => {
        const MailAsyncButton = document.querySelector(".a-sync-button-mail")
        let asyncMailCounter = 0;
        let MailAsyncTimeStart;

        MailAsyncButton?.addEventListener("click", async () => {
            MailAsyncTimeStart = Date.now();
            asyncMailCounter = 0;
            const response = fetch("getMailAsynchronously");
        })

        Echo.channel('asyncChannel')
            .listen('sendMailEventAsync', (e) => {
                console.log((Date.now() - MailAsyncTimeStart) / 1000 + "s");

                asyncMailCounter++;
                if (asyncMailCounter === 10) {
                    console.log("Mail Synchronous send: " + (Date.now() - MailAsyncTimeStart) / 1000 + "s");
                }
            })
    }

    const SynchronousMailHandler = () => {
        const MailSyncButton = document.querySelector(".sync-button-mail")
        let syncMailCounter = 0;
        let MailSyncTimeStart;

        MailSyncButton?.addEventListener("click", async () => {
            MailSyncTimeStart = Date.now();
            syncMailCounter = 0;
            const response = fetch("getMailSynchronously");
        })

        Echo.channel('syncChannel')
            .listen('sendMailEvent', (e) => {
                console.log((Date.now() - MailSyncTimeStart) / 1000 + "s");

                syncMailCounter++;
                if (syncMailCounter === 10) {
                    console.log("Mail Synchronous send: " + (Date.now() - MailSyncTimeStart) / 1000 + "s");
                }
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

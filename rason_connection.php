<script type="text/javascript" language="javascript">
        // This script demonstrates how you can solve RASON models in two ways. The first way is the 'Quick Solve' method and is intended
        // to be used with simple models that solve quickly. Solving harder models using the RASON REST API is demonstrated below as well.
        // This approach is intended for more complex models requiring more significant computational effort and time.
        var rasonApp = {
            RASONModelID: false,
            solveStopped: false,
            // URL fragment determining whether or not we are simulating or optimizing the model
            RASONEntry: '/optimize',
            RASONServer: 'https://rason.net/api',
            ////////////////////////////////////////////////////
            // The declarative model we will solve with this app
            RASONModel: {
    comment: "Example of non-smooth transformation. This inventory planning model was originally designed for linear programming, but to properly minimize holding costs, the objective had to depend on formulas which are sums of IF functions. Using the LP/Quadratic Solver yields the result simple linear mixed-integer model into difficult a non-smooth model. What can we do to find an optimal solution?",

    modelSettings: {
        transformNonSmooth: true
    },

    variables: {
        x1: {
            type: "int"
        },
        x2: {
            type: "int"
        }
        x3: {
            type: "int"
        }
    },

    objective: {
        obj: {
            type: "minimize",
            finalValue: [],
            formula: "346.00 * 0.25 * x1 + 69.00 * 0.25 * x1 + 63.00 * 0.25 * x1 + 57.00 * 0.15 * x1 + 136.00 * 0.1 * x2 + 63.00 * 0.25 * x2 + 53.00 * 0.3 * x3 + 359.00 * 0.1 * x3 + 110.00 * 0.1 * x3 + 47.30 * 0.1 * x3 + 62.00 * 0.25 * x1 + 4.50 * 0.25 * x1 + 7.10 * 0.25 * x1 + 14.00 * 0.15 * x1 + 31.70 * 0.1 * x2 + 7.10 * 0.25 * x2 + 7.30 * 0.3 * x3 + 75.00 * 0.1 * x3 + 0.00 * 0.1 * x3 + 9.40 * 0.1 * x3 + 11.00 * 0.25 * x1 + 3.60 * 0.25 * x1 + 5.20 * 0.25 * x1 + 0.74 * 0.15 * x1 + 3.90 * 0.1 * x2 + 5.20 * 0.25 * x2 + 2.40 * 0.3 * x3 + 11.50 * 0.1 * x3 + 22.00 * 0.1 * x3 + 1.20 * 0.1 * x3 + 4.00 * 0.25 * x1 + 4.10 * 0.25 * x1 + 1.50 * 0.25 * x1 + 0.33 * 0.15 * x1 + 0.20 * 0.1 * x2 + 1.50 * 0.25 * x2 + 0.40 * 0.3 * x3 + 1.30 * 0.1 * x3 + 2.30 * 0.1 * x3 + 0.50 * 0.1 * x3 - 5000"
        }
    }
},
            ////////////////////////////////////////////////////

            ajaxOpts: {
                headers: {
                    // Add the 'Authorization' header and bearer token to all requests. The value of the bearer token is the RASON token and
                    // can be verified at https://rason.com/Manage (after logging in)
                    'Authorization': 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoidXNlciIsInRpbWUiOiI2MCIsIm1vbnRoIjoiMTQ0MDAiLCJ2YXJpYWJsZXMiOiIyMDAiLCJsaW5lYXJfdmFycyI6IjIwMCIsIm5vbmxpbmVhcl92YXJzIjoiMTAwIiwidW5jZXJ0YWluX3ZhcnMiOiIyNCIsInVuY2VydGFpbl9mY25zIjoiMTIiLCJmdW5jdGlvbnMiOiIxMDAiLCJpbnRlZ2VycyI6IjIwMCIsImVuZ2luZXMiOiIwMDAwMDAwIiwibWF4VHJpYWxzIjoiMTAwMCIsInVzZXJpZCI6IjAiLCJ1c2VybmFtZSI6Im1hY2llai5qYWxvd2llY0BnbWFpbC5jb20iLCJwbGFuIjoiTm9uZSIsImlhdCI6IjE0ODE3MzA3MDEuODA0NTkiLCJqdGkiOiIwYzhlZWQ3ZTc4YTBjY2YwMmY0MTAwYjQzYzNkMjJkMCJ9.2z4OTgP2rO76GOco2YvWtnLswOMtxYWqtRi7vUeBPpc',
                    'Content-Type': 'application/json'
                },
                cache: false,
                context: this
            },


            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // A generic error handler that cleans up
            invokeFailed: function (jqXHR, textStatus, errorThrown) {
                if (!rasonApp.solveStopped) {
                    $('#_msg').append("Request failed: " + textStatus + ' ' + jqXHR.status + ': ' + jqXHR.statusText + ' ' + jqXHR.responseText);
                    if (rasonApp.RASONModelID) {
                        rasonApp.deleteModel();
                        // We are done. Clear the data
                        rasonApp.ajaxOpts.data = null;
                    }
                }
            },
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // The following 6 functions demonstrate how to solve/simulate difficult models requiring more significant computational
            // effort and time. Evaluating a model in this manner follows the pattern outlined below, starting at either the
            // 'startSolve', or 'startSimulate' function, invoked by clicking either the 'Optimize' or 'Simulate' button:
            //      startSolve/startSimulate -> getModelId -> status -> checkStatus -> results
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Entry point - the 'Simulate' button was clicked.
            startSimulate: function () {
                this.ajaxOpts.method = 'POST';
                this.ajaxOpts.data = JSON.stringify(this.RASONModel);
                this.RASONEntry = '/simulate';
                $.ajax(this.RASONServer + '/model', this.ajaxOpts).done(this.getModelId).fail(this.invokeFailed);
            },

            // Entry point - the 'Optimize' button was clicked.
            startSolve: function () {
                this.ajaxOpts.method = 'POST';
                this.ajaxOpts.data = JSON.stringify(this.RASONModel);
                this.RASONEntry = '/optimize';
                $('#_msg').append('Posting model to RASON service...');
                $.ajax(this.RASONServer + '/model', this.ajaxOpts).done(this.getModelId).fail(this.invokeFailed);
            },

            // Once the model has been posted to the RASON server by the 'startSolve' function above, get the model ID in order to track
            // it's 'solve' progress.
            getModelId: function (data, textStatus, jqXHR) {
                rasonApp.RASONModelID = jqXHR.getResponseHeader('location');
                // the model has been posted. there is no longer a need to send this data
                rasonApp.ajaxOpts.data = null;
                if (rasonApp.RASONModelID) {
                    var msg = '\n' + (rasonApp.RASONEntry == '/optimize' ? 'Optimizing...' : 'Simulating...');
                    $('#_msg').append('\nRASONModelID: ' + rasonApp.RASONModelID + msg);
                    // we have a model ID, move to the next step
                    setTimeout(function () {
                        rasonApp.ajaxOpts.method = 'GET';
                        // **** Note that the model has only been posted at this point. Below is the REST API invocation that begins solving the model. ******
                        // Get and add the query parameters to the request. They must be correctly entered in the input text box.
                        var queryParams = $('#_queryParams').val();
                        $.ajax(rasonApp.RASONModelID + rasonApp.RASONEntry + queryParams, rasonApp.ajaxOpts).done(rasonApp.status).fail(rasonApp.invokeFailed);
                    }, 1000);
                } else {
                    alert("No model ID");
                }
            },
            // this function, 'status', and the one below, 'checkStatus', form a loop that checks the model status on the rason server. This function imposes
            // a 2 second delay to avoid churning on difficult models.
            status: function (data, textStatus, jqXHR) {
                $('#_msg').append('\nChecking model status...');
                setTimeout(function () {
                    rasonApp.ajaxOpts.method = 'GET';
                    $.ajax(rasonApp.RASONModelID + '/status', rasonApp.ajaxOpts).done(rasonApp.checkStatus).fail(rasonApp.invokeFailed);
                }, 2000);
            },

            // We are looking for a status of 'Complete'. If the model is not solved (Complete), then we will check again. Of course
            // this is all subject to whether or not the 'Stop Optimize' button was clicked.
            checkStatus: function (data, textStatus, jqXHR) {
                $('#_msg').append('\nStatus: ' + (data && data.status ? data.status : 'Unknown'));
                if (data && data.status == "Complete") {
                    rasonApp.ajaxOpts.method = 'GET';
                    // the model is complete! Now get the results
                    $.ajax(rasonApp.RASONModelID + '/result', rasonApp.ajaxOpts).done(rasonApp.results).fail(rasonApp.invokeFailed);
                } else if (!rasonApp.solveStopped) {
                    rasonApp.status();
                }
            },

            // Print the results as a JSON string, showing the structure of the results object returned by the rason server
            results: function (data, textStatus, jqXHR) {
                var resultHtml = '\nResult:\n' + JSON.stringify(data, null, 2);
                $('#_msg').append(resultHtml);
                rasonApp.deleteModel();
            },

            ////////////////////////////////////////////////////////////////////////////////
            // It's generally a good idea to clean up when done. Models that are NOT deleted are
            // persisted at rason.net. However, the model ID is required to retrieve a model from rason.net.
            deleteModel: function () {
                if (rasonApp.RASONModelID) {
                    rasonApp.ajaxOpts.method = 'DELETE';
                    $.ajax(rasonApp.RASONModelID + '/delete', rasonApp.ajaxOpts);
                    var resultHtml = '\nModel deleted.';
                    $('#_msg').append(resultHtml);
                    rasonApp.RASONModelID = 0;
                }
            },
            ///////////////////////////////////////////////////////////////////////////
            // The following 2 functions demonstrate stopping a model that is currently being solved by the RASON API.
            stopOptimize: function () {
                if (this.RASONModelID) {
                    rasonApp.solveStopped = true;
                    this.ajaxOpts.method = 'POST';
                    // We are cleaning up in this case. Otherwise the 'done' callback could be omitted
                    $.ajax(this.RASONModelID + '/stop', this.ajaxOpts).done(this.stopped).fail(this.invokeFailed);
                }
            },

            stopped: function (data, textStatus, jqXHR) {
                var resultHtml = '\nModel stopped.';
                $('#_msg').append(resultHtml);
                rasonApp.deleteModel();
            }
        };

        $(document).ready(function () {
            $('#_userModel').html(JSON.stringify(rasonApp.RASONModel, null, 2));
        });
</script>
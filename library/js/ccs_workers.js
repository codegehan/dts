class Tools{
    static RandomNumber(length) {
        const randomNumber = Math.floor(Math.random() * Math.pow(10, length)).toString().padStart(length, '0');
        return randomNumber;
    }
    static RandomCode(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let randomCode = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            randomCode += characters.charAt(randomIndex);
        }
        return randomCode;
    }
    static FetchRecord(url, sp, data, tableBody, table=null){
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                spname: sp,
                jsonData: data
            },
            success: function(response) {
                $(tableBody).html(response);
                new DataTable(table);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    static RecordData(url, sp, data){
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    spname: sp,
                    jsonData: data
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    // console.log("Response: ", response)
                    resolve(result);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    reject(error);
                }
            });
        });
    }

    static InsertRecord(url, sp, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                spname: sp,
                jsonData: data,
            },
            success: function(response) {
                var res = JSON.parse(response);
                if(res.statuscode === 1) {
                    Swal.fire({
                        title: res.result,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'success'
                    });
                } else {
                    Swal.fire({
                        title: res.result,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    static ExecuteQuery(url, sp, data) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    spname: sp,
                    jsonData: data,
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    resolve(res);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    static GetInput(form){
        var formData = {};
        $('#' + form + ' :input, #' + form + ' select, #' + form + ' textarea').each(function() {
            var element = $(this);
            var key = element.attr('name');
            var value = element.val();
            if(key) { formData[key] = value } 
        });
        return JSON.stringify(formData);
    }
}
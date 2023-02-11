/**
 * java script -settings
 *
 * @since   2021-02-25
 */


/**
 * Constant
 * DO not change constant
 * 
 * Maped server side and client side
 * Maped html and javascript
 * Maped url pattern with  save , update and search
 * 
 */
const SAVE = "save";
const UPDATE = "update";

const SHIPPING_TERM = "ShippingTerm";
const PRODUCT_MIX = "ProductMix";
const WASHED_LEVEL = "WashedLevel";
const PLANT_HOLE_SIZE = "PlantHoleSize";
const DRAIN_HOLE_SIZE = "DrainHoleSize";
const DRAIN_HOLE_SHAPE = "DrainHoleShape";
const PRODUCT_SIZE = "ProductSize";
const SUB_SECTION = "SubSection";
const REASON = "Reason";


const TITLE_MAP = {
    'saveShippingTerm': 'Add new shipping term',
    'saveProductMix': 'Add new product mix',
    'saveWashedLevel': 'Add new washed level',
    'savePlantHoleSize': 'Add new plant hole size',
    'saveDrainHoleSize': 'Add new Drain hole size',
    'saveDrainHoleShape': 'Add new Drain hole shape',
    'saveProductSize': 'Add new Product size',
    'saveReason': 'Add new Reason',
   

    'updateShippingTerm': 'Update shipping term',
    'updateProductMix': 'Update product mix',
    'updateWashedLevel': 'Update washed level',
    'updatePlantHoleSize': 'Update plant hole size',
    'updateDrainHoleSize': 'Update Drain hole size',
    'updateDrainHoleShape': 'Update Drain hole shape',
    'updateProductSize': 'Update Product size',
    'updateReason': 'Update Reason',
};


const URL_MAP = {
    'ShippingTerm': '/settings/shippingterm',
    'ProductMix': '/settings/productmix',
    'WashedLevel': '/settings/washedlevel',
    'PlantHoleSize': '/settings/plantholesize',
    'DrainHoleSize': '/settings/drainholesize',
    'DrainHoleShape': '/settings/drainholeshape',
    'ProductSize': '/settings/productsize',
    'Reason': '/settings/reason',
  
    
};

const DELETE_MAP ={
    'ShippingTerm':'/settings/shippingterm/delete',
    'ProductMix': '/settings/productmix/delete',
    'WashedLevel': '/settings/washedlevel/delete',
    'PlantHoleSize': '/settings/plantholesize/delete',
    'DrainHoleSize': '/settings/drainholesize/delete',
    'DrainHoleSize': '/settings/drainholeshape/delete',
    'ProductSize': '/settings/productsize/delete',
    'Reason': '/settings/reason/delete',
};

const URL_MAP_SEARCH = {
    'ShippingTerm': '/settings/shippingterms',
    'ProductMix': '/settings/productmixes',
    'WashedLevel': '/settings/washedlevels',
    'PlantHoleSize': '/settings/plantholesizes',
    'DrainHoleSize': '/settings/drainholesizes',
    'DrainHoleShape': '/settings/drainholeshape',
    'ProductSize': '/settings/productsize',
    'Reason': '/settings/reason',
    
};


/**
* showModal
* This function is used to open modal.
* @param event This is the paramter to identify save/update
* @param name This is the paramter to identify settings name
*/
function showModal(event, name) {

    var title = TITLE_MAP[event + name];

    $('#txtSettingName').attr('name', name);
    $('#settingsAddModalTitle').text(title);

    if(name == REASON){
        $('#lblNameModal').text('Reason');
    }
    if (event == SAVE) {
        $('#btnSetting').attr('name', 'save');
        $('#btnSetting').text('Save');
        $('#txtSettingName').val('');
    }
    if (event == UPDATE) {
        $('#btnSetting').attr('name', 'update');
        $('#btnSetting').text('Update');
        var evt = $('.table tbody').on('click', '.btn', function (event) {
            var currow = $(this).closest('tr');
            var id = currow.find('td:eq(0)').attr('id');
            var value = currow.find('td:eq(1)').text();
            $('#settingID').val(id);
            $('#txtSettingName').val(value);
            if (name == SUB_SECTION) {
                var section = currow.find('td:eq(1)').attr('id');
                $('#selcSection').attr('value', section);
            }
        });

    }

    $("#settingsAddModal").modal('toggle');
}


/**
* JQuery
* This is used to call save function and update function
* Used url pattern
*/
$(document).ready(function () {

    //Toast library for message
    toastr.options = {
        timeOut: 3000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200
    };
    ////////////

    $('#btnSetting').click(function (event) {
        event.preventDefault();

        var key = $('#txtSettingName').attr('name');
        var url = URL_MAP[key];
        var _token = $("input[name='_token']").val();

        var evt = event.target.name;

        if (evt == SAVE) {

            var value = $('#txtSettingName').val();

            var form = new FormData();
            form.append("_token", _token);
            form.append("value", value);
            if (key == SUB_SECTION) {
                var section_id = $('#selcSection').val();
                form.append("section_id", section_id);
            }
            save(url, form);

        } else if (evt == UPDATE) {

            var id = $('#settingID').val();
            update(url, id);

        }

    });


});


/**
* save
* This function is used to save settings.
* @param url This is the paramter to ajax request url 
* @param form This is the paramter to ajax data
*/
function save(url, form) {

    $.ajax({
        type: "POST",
        url: url,
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
            $("#settingsAddModal").modal('hide');
        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Settings has been saved successfully...");
                getSettings(response.data.name);

            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {

        }

    });
}


/**
* update
* This function is used to update settings.
* @param url This is the paramter to ajax request url 
* @param id This is the paramter to ajax data
*/
function update(url, id) {

    $.ajax({
        type: 'PUT',
        url: url + '/' + id,
        data: $('#myForm').serialize(),
        timeout: 800000,
        beforeSend: function () {
            $("#settingsAddModal").modal('hide');
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                showSuccessMessage("Settings has been updated successfully...");
                getSettings(response.data.name);

            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {

        }

    });
}



/**
* delete
* This function is used to update settings.
* @param url This is the paramter to ajax request url 
* @param id This is the paramter to ajax data
*/
function _delete(url, id, status) {

    var bool = 0;
    if (status) bool = 1;

    $.ajax({
        type: 'DELETE',
        url: url + '/' + id,
        data: {
            _token: $('input[name=_token]').val(),
            "status": bool
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                if (status) showSuccessMessage("Data has been enabled successfully...");
                if (!status) showSuccessMessage("Data has been disabled successfully...");

                getSettings(response.data.name);

            } else {
                var msg = response.data.message;
                var id = response.data.result;

                if (msg == "assigned") {//assigned settings cannot be disabled
                    showWarningMessage("Settings has been assigned...!");
                    getSettings(response.data.name);
                } else if (msg == "error") {
                    showErrorMessage();
                }
            }

        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {

        }

    });
}



/**
* save
* This function is used to disable settings.
* @param event This is the paramter to identifi desable/enable 
*/
function disable(event, name) {

    var url = URL_MAP[name];
    var id = event.target.id;
    var status = event.target.checked;
    _delete(url, id, status);
}


/**
* delete
* This function is used to update settings.
* @param url This is the paramter to ajax request url 
* @param id This is the paramter to ajax data
*/
function _deleted(id,name) {
    //alert(id + "  "+name);
   
    $.ajax({
        type: 'DELETE',
        url:  DELETE_MAP[name] + '/' + id,
        data: {
            _token: $('input[name=_token]').val(),
           
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                showSuccessMessage("Settings record has been deleted successfully...")
                getSettings(response.data.name);

            } else {
                
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {

        }

    });
}









/**
* save
* This function is used to search settings.
* @param key This is the paramter to identifi ajax request url 
*/
function getSettings(key) {

    var url = URL_MAP_SEARCH[key];
    $.ajax({
        type: "GET",
        url: url,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                var name = response.data.name;
                var result = response.data.result;
                loadTable(name, result);

            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {
            $('.ti-settings').show();
            $('.spinner-border').hide();
        }

    });
}



/**
* showSuccessMessage
* This function is used to show success message.
* @param message This is the paramter to require message content
*/
function showSuccessMessage(message) {

    toastr.success(message);
}



/**
* showErrorMessage
* This function is used to show error message.
* @param message This is the paramter to require message content
*/
function showErrorMessage() {
    toastr.error('Something went wrong');
}


/**
* showWarrningMessage
* This function is used to show warning message.
* @param message This is the paramter to require message content
*/
function showWarningMessage(message) {

    toastr.warning(message);
}


/**
* loadTable
* This function is used to data set on the tables.
* @param name This is the paramter to identifi table name
* @param name This is the paramter to require table content
*/
function loadTable(name, result) {

    var disable = { 0: "", 1: "checked" }
    var tbody = "";
    var tableName = "#tbl" + name;
    
    for (i = 0; i < result.length; i++) {

        var row = "<tr>";

        if (name == SHIPPING_TERM) {

            row += '<td class="id" id="' + result[i].shipping_term_id + '">' + generateID(result[i].shipping_term_id) + '</td>';
            row += '<td>' + result[i].shipping_term + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].shipping_term_id + '" onclick="showModal(' + "'update'" + ',' + "'ShippingTerm'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].shipping_term_id + '" onclick="_deleted(' + result[i].shipping_term_id + ','+"'ShippingTerm'"+')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].shipping_term_id + '" onchange="disable(event,' + "'ShippingTerm'" + ')" ' + disable[result[i].status] + '>';
            
        } else if (name == PRODUCT_MIX) {

            row += '<td class="id" id="' + result[i].product_mix_id + '">' + generateID(result[i].product_mix_id) + '</td>';
            row += '<td>' + result[i].product_mix + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].product_mix_id + '" onclick="showModal(' + "'update'" + ',' + "'ProductMix'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].product_mix_id + '" onclick="_deleted(' + result[i].product_mix_id + ',' + "'ProductMix'" + ' )">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].product_mix_id + '" onchange="disable(event,' + "'ProductMix'" + ')" ' + disable[result[i].status] + '>';

        } else if (name == WASHED_LEVEL) {

            row += '<td class="id" id="' + result[i].washed_level_id + '">' + generateID(result[i].washed_level_id) + '</td>';
            row += '<td>' + result[i].washed_level + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].washed_level_id + '" onclick="showModal(' + "'update'" + ',' + "'WashedLevel'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].washed_level_id + '" onclick="_deleted(' + result[i].washed_level_id + ',' + "'WashedLevel'" + ')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].washed_level_id + '" onchange="disable(event,' + "'WashedLevel'" + ')" ' + disable[result[i].status] + '>';

        } else if (name == PLANT_HOLE_SIZE) {

            row += '<td class="id" id="' + result[i].plant_hole_size_id + '">' + generateID(result[i].plant_hole_size_id) + '</td>';
            row += '<td>' + result[i].plant_hole_size + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].plant_hole_size_id + '" onclick="showModal(' + "'update'" + ',' + "'PlantHoleSize'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].plant_hole_size_id + '" onclick="_deleted(' + result[i].plant_hole_size_id + ',' + "'PlantHoleSize'" +')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].plant_hole_size_id + '" onchange="disable(event,' + "'PlantHoleSize'" + ')" ' + disable[result[i].status] + '>';

        } else if (name == DRAIN_HOLE_SIZE) {

            row += '<td class="id" id="' + result[i].drain_hole_size_id + '">' + generateID(result[i].drain_hole_size_id) + '</td>';
            row += '<td>' + result[i].size + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].drain_hole_size_id + '" onclick="showModal(' + "'update'" + ',' + "'DrainHoleSize'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].drain_hole_size_id + '" onclick="_deleted(' + result[i].drain_hole_size_id + ',' + "'DrainHoleSize'" +')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].drain_hole_size_id + '" onchange="disable(event,' + "'DrainHoleSize'" + ')" ' + disable[result[i].status] + '>';

        }  else if (name == DRAIN_HOLE_SHAPE) {

            row += '<td class="id" id="' + result[i].drain_hole_shape_id + '">' + generateID(result[i].drain_hole_shape_id) + '</td>';
            row += '<td>' + result[i].shape + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].drain_hole_shape_id + '" onclick="showModal(' + "'update'" + ',' + "'DrainHoleShape'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].drain_hole_shape_id + '" onclick="_deleted(' + result[i].drain_hole_shape_id + ',' + "'DrainHoleShape'" +')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].drain_hole_shape_id + '" onchange="disable(event,' + "'ProductSize'" + ')" ' + disable[result[i].status] + '>';

        }  else if (name == PRODUCT_SIZE) {

            row += '<td class="id" id="' + result[i].product_size_id + '">' + generateID(result[i].product_size_id) + '</td>';
            row += '<td>' + result[i].size + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].product_size_id + '" onclick="showModal(' + "'update'" + ',' + "'ProductSize'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].product_size_id + '" onclick="_deleted(' + result[i].product_size_id + ',' + "'ProductSize'" +')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].product_size_id + '" onchange="disable(event,' + "'ProductSize'" + ')" ' + disable[result[i].status] + '>';

        }  else if (name == REASON) {

            row += '<td class="id" id="' + result[i].reason_id + '">' + generateID(result[i].reason_id) + '</td>';
            row += '<td>' + result[i].reason + '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-primary setting-edit-btn" id="' + result[i].reason_id + '" onclick="showModal(' + "'update'" + ',' + "'Reason'" + ')">';
            row += '<i class="fa fa-pencil-square-o" aria-hidden="true"></button>';

            row += '</td>';
            row += '<td class="edit">';
            row += '<button type="button" class="btn btn-danger setting-edit-btn" id="' + result[i].reason_id + '" onclick="_deleted(' + result[i].reason_id + ',' + "'Reason'" +')">';
            row += '<i class="fa fa-trash" aria-hidden="true"></button>';
            row += '</td>';
            row += '<td class="disable">';
            row += '<label class="switch">';
            row += '<input type="checkbox" id="' + result[i].reason_id + '" onchange="disable(event,' + "'Reason'" + ')" ' + disable[result[i].status] + '>';

        }
        row += '<span class="slider round"></span>';
        row += '</label>';
        row += '</td>';
        row += '</tr>';
        tbody += row;
    }

    $(tableName).empty();
    $(tableName).append(tbody);

}



/**
* generateID
* This function is used to generate id
* @param id This is the paramter to require id
*/
function generateID(id) {

    let pattern = {
        1: "000",
        2: "00",
        3: "0",
    };
    var length = Math.ceil(Math.log(id + 1) / Math.LN10);
    return pattern[length] + id;
}




function makeSectionElement(id, section) {
    var element = '<option value="' + id + '">' + section + '</option>';
    $('#selcSection').append(element);
}

function setSelected_Section_to_SubSection(section) {
    $("#selcSection option").filter(function () {
        return $(this).text() == section;
    }).prop('selected', true);
}




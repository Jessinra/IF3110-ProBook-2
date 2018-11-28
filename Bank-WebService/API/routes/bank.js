'use strict';
module.exports = function (app) {
    var bankController = require('../controllers/bank');

    // bank_controller Routes
    app.route('/validateCard/:cardId')
        .get(bankController.validate_card);
    app.route('/transfer')
        .post(bankController.transfer);
    app.route('/generateOTP')
        .post(bankController.generateOTP);


    app.route('/generateOTP')
        .get(bankController.testOTP);

    app.route('/verifyOtp/:cardId/:otp')
        .get(bankController.verifyOTP);

};
var Bank = require('../models/bank');

exports.validate_card = function (req, res) {
    Bank.validateCard(req.params['cardId'], function (err, nasabah) {
        if (err) {
            res.send(err);
        } else {
            if (nasabah.length === 0) {
                res.json("False");
            } else {
                res.json("True");
            }
        }
    });
};

exports.transfer = function (req, res) {
    console.log(req.body.nomor_pengirim);
    Bank.getBalanceByCardNumber(req.body["nomor_pengirim"], function (err, saldo) {
        if (err) {
            res.send(err);
        } else {
            console.log("saldo", saldo[0]['saldo']);
            console.log("jumlah", req.body["jumlah"]);
            if (saldo[0]['saldo'] < req.body["jumlah"]) {
                res.json({err: "True", message: "Saldo tidak mencukupi."});
            } else {
                Bank.subtractBalanceByCardNumber(req.body["jumlah"], req.body["nomor_pengirim"], function (err, nasabah) {
                    if (err) {
                        res.send(err);
                    }
                });
                Bank.addBalanceByCardNumber(req.body["jumlah"], req.body["nomor_penerima"], function (err, nasabah) {
                    if (err) {
                        res.send(err);
                    }
                });
                Bank.createTransaction(req.body["nomor_pengirim"], req.body["nomor_penerima"], req.body["jumlah"], function (err, transaksi) {
                    if (err) {
                        res.send(err);
                    } else {
                        res.json(transaksi);
                    }
                });
            }
        }
    });
};

var OTP = require('otp.js');
let HOTPGen = OTP.hotp;

function generateRandomNumber(min_value, max_value) {
    let random_number = Math.random() * (max_value - min_value) + min_value;
    return Math.floor(random_number);
}

exports.generateOTP = function (req, res) {
    let cardId = req.body["nomor_pengirim"];
    let randomKey = generateRandomNumber(1000000000, 9999999999);
    let randomPad = randomKey.toString().slice(0, 2);
    let code = HOTPGen.gen({string: cardId.toString() + randomKey.toString()});

    Bank.addToken(cardId, randomKey, function (err, res) {});
    res.json(randomPad + code);
};

exports.verifyOTP = function (req, res) {

    let cardId = req.params['cardId'];
    let otpToken = req.params['otp'];
    let randomPad = otpToken.slice(0, 2);
    otpToken = otpToken.slice(2, 8);

    Bank.getToken(cardId, function (err, tokenKey) {
        if (err) {
            res.send(err);
        } else {
            // Not found in database
            if (tokenKey === undefined || tokenKey.length === 0){
                res.json(false);
            }
            // Found, need to validate
            else{
                let randomKey = tokenKey[0]['tokenKey'];
                let authenticated_01 = HOTPGen.verify(otpToken, {string: cardId.toString() + randomKey.toString()}) != null;
                let authentication_02 = randomPad === tokenKey[0]['tokenKey'].slice(0, 2);

                if (authenticated_01 && authentication_02) {
                    Bank.removeOTP(cardId, function (err, removeResult) {});
                }
                // Return authenticated or not
                res.json(authenticated_01 && authentication_02);
            }
        }
    });
};

exports.testOTP = function (req, res) {

    let request = require('request');

    request.post(
        'http://localhost:3000/generateOTP',
        {json: {'nomor_pengirim': '2348793875'}},
        function (error, response, body) {
            if (!error && response.statusCode === 200) {
                console.log(`body content :${body}`);
            }
        }
    );

    res.send("");
};
var mysql = require('mysql');

var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "bank"
});

con.connect(function (err) {
    if (err) {
        console.log('Error connecting to Db');
        return;
    }
    console.log('Database connected');
});

var Bank = function () {
};

Bank.validateCard = function (cardId, callback) {
    con.query("SELECT * FROM nasabah WHERE nomor_kartu = ?", cardId, function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.getBalanceByCardNumber = function (cardId, callback) {
    con.query("SELECT saldo FROM nasabah WHERE nomor_kartu = ?", cardId, function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.subtractBalanceByCardNumber = function (deltaSaldo, cardId, callback) {
    con.query("UPDATE nasabah SET saldo = saldo - ? WHERE nomor_kartu = ?", [deltaSaldo, cardId], function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.addBalanceByCardNumber = function (deltaSaldo, cardId, callback) {
    con.query("UPDATE nasabah SET saldo = saldo + ? WHERE nomor_kartu = ?", [deltaSaldo, cardId], function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.createTransaction = function (senderCardNumber, recCardNumber, deltaSaldo, callback) {
    con.query("INSERT INTO transaksi (nomor_pengirim, nomor_penerima, jumlah) VALUES (?, ?, ?)", [senderCardNumber, recCardNumber, deltaSaldo], function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.addToken = function (senderCardId, OTPKey, callback) {
    con.query("INSERT INTO otp (cardId, tokenKey) VALUES (?, ?)", [senderCardId, OTPKey], function (err, res) {
        if (err) {

            // If the record is existed already, overwrite it
            con.query("UPDATE otp SET tokenKey = ? WHERE cardId = ?", [OTPKey, senderCardId], function (err, res) {
                if (err) {
                    console.log("error: ", err);
                    callback(err, null);
                }
                else {
                    callback(null, res);
                }
            });
        }
        else {
            callback(null, res);
        }
    });
};

Bank.removeOTP = function (senderCardId, callback) {
    con.query("DELETE FROM otp WHERE cardId = ?", senderCardId, function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            callback(null, res);
        }
    });
};

Bank.getToken = function (senderCardId, callback) {
    con.query("SELECT tokenKey FROM otp WHERE cardId = ?", senderCardId, function (err, res) {
        if (err) {
            console.log("error: ", err);
            callback(err, null);
        }
        else {
            console.log("from inside");
            console.log(res);
            callback(null, res);
        }
    });
};

module.exports = Bank;
function isStrongPassword(password) {
    if (password.length < 8) {
        console.log("No Good! Password must be at least 8 characters long.");
        return false;
    } else if (password.includes("1234")) {
        console.log("No Good! Password can't contain the numbers '1234' in a row.");
        return false;
    } else if (password.includes("password")) {
        console.log("No Good! Password can't contain the word 'password'.");
        return false;
    } else if (!/\d/.test(password)) {
        console.log("No Good. Password must contain at least one number.");
        return false;
    } else {
        console.log("Good Password!!!!");
        return true;
    }
}


isStrongPassword("qwerty1"); // false - Too short
isStrongPassword("qwertypassword1") // false - Contains "password"
isStrongPassword("qwertyABC") // false - No numbers
isStrongPassword("qwerty123") // true

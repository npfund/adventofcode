extern crate crypto;

use crypto::digest::Digest;
use crypto::md5::Md5;

fn main() {
    let input = "bgvyzdsv";
    let target = "00000";

    let mut number = 0;

    let mut md5 = Md5::new();

    md5.input_str(&*(format!("{}{}", input, number)));

    while !md5.result_str().starts_with(target) {
        md5.reset();
        number += 1;
        md5.input_str(&*(format!("{}{}", input, number)));
    }

    println!("{}", number);
}

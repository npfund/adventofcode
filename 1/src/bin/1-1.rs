fn main() {
    let input = include_str!("1.txt").trim();
    let mut floor = 0;

    for paren in input.chars() {
        if paren == '(' {
            floor = floor + 1;
        } else {
            floor = floor - 1;
        }
    }

    println!("floor {}", floor);
}

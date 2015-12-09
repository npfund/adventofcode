fn main() {
    let input = include_str!("1.txt").trim();
    let mut floor = 0;

    for (index, paren) in input.chars().enumerate() {
        if paren == '(' {
            floor = floor + 1;
        } else {
            floor = floor - 1;
        }

        if floor == -1 {
            println!("{}", index + 1);
            break;
        }
    }
}

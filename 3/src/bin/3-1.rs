use std::collections::HashSet;

fn main() {
    let directions = include_str!("3.txt").trim();

    let mut houses = HashSet::new();

    let mut position = (0, 0);

    houses.insert(position);

    for direction in directions.chars() {
        match direction {
            '^' => position.1 += 1,
            'v' => position.1 -= 1,
            '<' => position.0 -= 1,
            '>' => position.0 += 1,
            _ => println!("Weird direction!"),
        }
        houses.insert(position);
    }

    println!("{}", houses.len());
}

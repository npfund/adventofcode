use std::collections::HashSet;

fn main() {
    let directions = include_str!("3.txt").trim();

    let mut houses = HashSet::new();

    let mut santa = (0, 0);
    let mut robot = (0, 0);

    houses.insert(santa);

    for (index, direction) in directions.chars().enumerate() {
        let mut position = &mut santa;

        if index % 2 == 1 {
           position = &mut robot;
        }
        
        match direction {
            '^' => (*position).1 += 1,
            'v' => (*position).1 -= 1,
            '<' => (*position).0 -= 1,
            '>' => (*position).0 += 1,
            _ => println!("Weird direction!"),
        }
        houses.insert(*position);
    }

    println!("{}", houses.len());
}

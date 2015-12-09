use std::cmp;

fn main() {
    let boxes: Vec<&str> = include_str!("2.txt").lines().collect();

    let mut total = 0;

    for line in boxes {
        let parts: Vec<&str> = line.split('x').collect();
        
        let length = parts[0].parse::<u32>().unwrap();
        let width = parts[1].parse::<u32>().unwrap();
        let height = parts[2].parse::<u32>().unwrap();

        let side1 = 2 * length * width;
        let side2 = 2 * width * height;
        let side3 = 2 * length * height;

        total += side1 + side2 + side3 + (cmp::min(side1, cmp::min(side2, side3)) / 2);
    }

    println!("{}", total);
}

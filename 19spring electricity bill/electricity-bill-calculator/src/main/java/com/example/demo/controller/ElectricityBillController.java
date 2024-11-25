package com.example.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

@Controller
public class ElectricityBillController {

    @GetMapping("/")
    public String showForm() {
        return "index";
    }

    @PostMapping("/calculate")
    @ResponseBody
    public double calculateBill(@RequestParam("units") int units) {
        double billAmount = 0;

        if (units <= 50) {
            billAmount = units * 3.50;
        } else if (units <= 150) {
            billAmount = 50 * 3.50 + (units - 50) * 4.00;
        } else if (units <= 250) {
            billAmount = 50 * 3.50 + 100 * 4.00 + (units - 150) * 5.20;
        } else {
            billAmount = 50 * 3.50 + 100 * 4.00 + 100 * 5.20 + (units - 250) * 6.50;
        }

        return billAmount;
    }
}

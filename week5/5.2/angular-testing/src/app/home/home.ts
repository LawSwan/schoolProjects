import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { User, UsersService } from '../services/users/users';

@Component({
  selector: 'app-home',
  imports: [CommonModule],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home implements OnInit {
  users = new Array<User>();

  constructor(private usersService: UsersService) {}

  ngOnInit(): void {
    this.usersService.all().subscribe((res) => {
      this.users = res;
    });
  }
}

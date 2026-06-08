import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';

export type User = {
  id: string;
  name: string;
  role: string;
  pokemon: string;
};

@Injectable({
  providedIn: 'root',
})
export class UsersService {
  users: Array<User> = [
    {
      id: '1',
      name: 'Jane',
      role: 'Designer',
      pokemon: 'Blastoise'
    },
    {
      id: '2',
      name: 'Bob',
      role: 'Developer',
      pokemon: 'Charizard'
    },
    {
      id: '3',
      name: 'Jim',
      role: 'Developer',
      pokemon: 'Venusaur'
    },
    {
      id: '4',
      name: 'Adam',
      role: 'Designer',
      pokemon: 'Yoshi'
    }
  ];

  all(): Observable<Array<User>> {
    return of(this.users);
  }

  findOne(id: string): Observable<User | undefined> {
    const user = this.users.find((u: User) => {
      return u.id === id;
    });

    return of(user);
  }
}

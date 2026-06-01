import { Component, NgZone, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { CrudService } from 'src/app/service/crud.service';

@Component({
	selector: 'app-add-book',
	templateUrl: './add-book.component.html',
	styleUrls: ['./add-book.component.css']
})
export class AddBookComponent implements OnInit {
	bookForm: FormGroup;

	constructor(
		public formBuilder: FormBuilder,
		private router: Router,
		private ngZone: NgZone,
		private crudService: CrudService
	) {
		this.bookForm = this.formBuilder.group({
			isbn: [''],
			title: [''],
			author: [''],
			description: [''],
			published_year: [''],
			publisher: ['']
		});
	}

	ngOnInit(): void {}

	onSubmit(): void {
		this.crudService.AddBook(this.bookForm.value).subscribe({
			next: () => {
				this.ngZone.run(() => this.router.navigateByUrl('/books-list'));
			},
			error: (err) => console.log(err)
		});
	}
}
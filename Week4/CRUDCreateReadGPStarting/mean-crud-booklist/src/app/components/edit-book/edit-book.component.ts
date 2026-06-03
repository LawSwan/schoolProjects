import { Component, NgZone, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { CrudService } from 'src/app/service/crud.service';

@Component({
	selector: 'app-edit-book',
	templateUrl: './edit-book.component.html',
	styleUrls: ['./edit-book.component.css']
})
export class EditBookComponent implements OnInit {
	bookForm: FormGroup;
	bookId: string = '';

	constructor(
		public formBuilder: FormBuilder,
		private router: Router,
		private route: ActivatedRoute,
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

	ngOnInit(): void {
		this.bookId = this.route.snapshot.paramMap.get('id') || '';
		this.crudService.GetBook(this.bookId).subscribe((book: any) => {
			this.bookForm.patchValue({
				isbn: book.isbn,
				title: book.title,
				author: book.author,
				description: book.description,
				published_year: book.published_year,
				publisher: book.publisher
			});
		});
	}

	onSubmit(): void {
		this.crudService.UpdateBook(this.bookId, this.bookForm.value).subscribe({
			next: () => {
				this.ngZone.run(() => this.router.navigateByUrl('/books-list'));
			},
			error: (err) => console.log(err)
		});
	}
}

import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-contacto-list',
  imports: [CommonModule],
  templateUrl: './contacto-list.component.html',
  styleUrl: './contacto-list.component.css'
})
export class ContactoListComponent implements OnInit {
  contactos: Contacto[] = [];

  constructor(private contactoService: ContactoService, private router: Router) {
  }

  ngOnInit(): void {
    this.getContactos();
  }

  getContactos(): void {
    this.contactoService.getContactos().subscribe({
      next: (result: Contacto[]) => {
        console.log("Datos OK ", result);
        this.contactos = result;
      },

      error: (error: any) => {
        console.error("Error de api", error);
      }
    })
  }
}
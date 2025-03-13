import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';

@Component({
  selector: 'app-contactos',
  imports: [],
  templateUrl: './contactos.component.html',
  styleUrl: './contactos.component.css'
})
export class ContactosComponent implements OnInit {

  contactos: Contacto[] = [];

  constructor(private contactoservi:ContactoService) {
   }

  ngOnInit(): void {
    this.obtenerContactos();
    };
  
  obtenerContactos(){
    this.contactoservi.getContactos().subscribe((data)=>{this.contactos=data})
  }

}
